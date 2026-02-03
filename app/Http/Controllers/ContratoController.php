<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\Trabajador;
use App\Models\Plantilla;
use App\Models\ListaNegra;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Services\GeneradorContratosPDF;
use App\Services\GeneradorCodigoContrato;

class ContratoController extends Controller
{
    /**
     * Listar todos los contratos
     */
    public function index(Request $request): View
    {
        // Verificar permiso
        if (!auth()->user()->can('view.contratos')) {
            abort(403, 'No tienes permiso para ver contratos.');
        }

        // Búsqueda y filtros
        $search = $request->input('search');
        $estado = $request->input('estado');
        $tipo = $request->input('tipo');

        // Query base con relaciones
        $query = Contrato::with('trabajador', 'plantilla');

        // Filtro: Búsqueda por DNI o Nombre del trabajador
        if ($search) {
            $query->whereHas('trabajador', function ($q) use ($search) {
                $q->where('dni', 'like', "%{$search}%")
                  ->orWhere('nombre_completo', 'like', "%{$search}%");
            });
        }

        // Filtro: Estado
        if ($estado) {
            $query->where('estado', $estado);
        }

        // Filtro: Tipo de Contrato
        if ($tipo) {
            $query->where('tipo_contrato', $tipo);
        }

        // Obtener contratos con paginación
        $contratos = $query->orderBy('created_at', 'desc')->paginate(15);

        // Opciones de filtros
        $estados = ['Borrador', 'Enviado a firmar', 'Firmado', 'Activo', 'Vencido', 'Cancelado'];
        $tipos = ['Temporal', 'Por incremento de actividad', 'Indefinido', 'Practicante'];

        return view('contratos.index', compact('contratos', 'estados', 'tipos', 'search', 'estado', 'tipo'));
    }

    /**
     * Mostrar formulario para crear nuevo contrato
     */
    public function create(): View
    {
        // Verificar permiso
        if (!auth()->user()->can('create.contratos')) {
            abort(403, 'No tienes permiso para crear contratos.');
        }

        // Obtener trabajadores ACTIVOS y NO bloqueados en lista negra
        $trabajadores = Trabajador::where('estado', 'Activo')
            ->whereNotIn('dni', function ($query) {
                $query->select('dni')
                    ->from('lista_negra')
                    ->where('estado', 'Bloqueado');
            })
            ->orderBy('nombre_completo')
            ->get();

        $plantillas = Plantilla::where('activa', true)->get();
        $tipos = ['Para servicio específico', 'Por incremento de actividad', 'Otros'];
        $horarios = ['8 horas', '14x7', '5x2', 'Otros'];

        return view('contratos.create', compact('trabajadores', 'plantillas', 'tipos', 'horarios'));
    }

    /**
     * Guardar nuevo contrato en base de datos
     */
    public function store(Request $request): RedirectResponse
    {
        // Verificar permiso
        if (!auth()->user()->can('create.contratos')) {
            abort(403, 'No tienes permiso para crear contratos.');
        }

        // Verificar si el trabajador está en lista negra ANTES de validar
        $dni = $request->input('dni');
        $trabajadorEnListaNegra = ListaNegra::where('dni', $dni)
            ->where('estado', 'Bloqueado')
            ->first();

        if ($trabajadorEnListaNegra) {
            return back()
                ->with('error', '⚠️ No se puede crear contrato. El trabajador está en lista negra.')
                ->with('trabajador_bloqueado', true)
                ->with('dni_bloqueado', $dni)
                ->with('motivo_bloqueo', $trabajadorEnListaNegra->descripcion_motivo)
                ->with('tipo_bloqueo', $trabajadorEnListaNegra->motivo)
                ->withInput();
        }

        // ✅ VALIDACIÓN CORREGIDA - AGREGADO DNI
        $validated = $request->validate([
            'dni' => 'required|exists:trabajadores,dni',
            'tipo_contrato' => 'required|in:Para servicio específico,Por incremento de actividad,Otros',
            'fecha_inicio' => 'required|date|before_or_equal:fecha_fin',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'fecha_firma_manual' => 'nullable|date|before_or_equal:fecha_inicio',
            'tipo_salario' => 'required|in:Mensual,Jornal,Ambos',
            'salario_mensual' => 'nullable|numeric|min:0',
            'salario_jornal' => 'nullable|numeric|min:0',
            'horario' => 'required|in:8 horas,14x7,5x2,Otros',
            'plantilla_id' => 'required|exists:plantillas,id',
            'beneficios_descripcion' => 'nullable|string',
        ]);

        // ✅ ========== NUEVA LÓGICA: SINCRONIZAR FECHA_INGRESO CON FECHA_INICIO ==========
        // Obtener el trabajador
        $trabajador = Trabajador::where('dni', $dni)->first();
        
        if ($trabajador) {
            // Obtener la fecha_inicio del contrato que se va a crear
            $fechaInicio = Carbon::parse($validated['fecha_inicio']);
            
            // SIEMPRE actualizar la fecha_ingreso del trabajador con la fecha_inicio del nuevo contrato
            $trabajador->update([
                'fecha_ingreso' => $fechaInicio->toDateString()
            ]);
            
            // Recalcular fecha_fin (sumando 3 meses a fecha_inicio)
            $validated['fecha_fin'] = $fechaInicio->copy()->addMonths(3)->toDateString();
        }
        // ✅ ========== FIN DE NUEVA LÓGICA ==========

        // GENERAR CÓDIGO AUTOMÁTICO
        try {
            $plantilla_id = (int)$validated['plantilla_id'];
            $codigoContrato = GeneradorCodigoContrato::generar($plantilla_id);
            
            // Obtener el registro de codigo_contratos para almacenar su ID
            $codigoBase = GeneradorCodigoContrato::obtenerCodigoBase($plantilla_id);
            $codigoBaseFila = \App\Models\CodigoContrato::where('codigo_base', $codigoBase)->first();
            
            $validated['numero_contrato'] = $codigoContrato;
            $validated['codigo_base_id'] = $codigoBaseFila->id ?? null;
            
        } catch (\Exception $e) {
            return back()
                ->with('error', '❌ Error al generar código de contrato: ' . $e->getMessage())
                ->withInput();
        }

        // CALCULAR FECHA DE FIRMA MANUAL
        if (empty($validated['fecha_firma_manual'])) {
            $fechaInicio = Carbon::parse($validated['fecha_inicio']);
            $validated['fecha_firma_manual'] = $fechaInicio->subDay()->toDateString();
        }

        // Otros campos
        $validated['estado'] = 'Borrador';
        $validated['beneficios_ley_728'] = true;
        $validated['created_by'] = auth()->id();
        $validated['tiempo_acumulado_meses'] = 0;

        // Crear contrato
        $contrato = Contrato::create($validated);

        return redirect()->route('contratos.show', $contrato->id)
                        ->with('success', '✅ Contrato creado exitosamente con código: ' . $codigoContrato);
    }

    /**
     * Mostrar detalle del contrato
     * GET /contratos/{id}
     * ✅ CORREGIDO: Mostrar años, meses y días por separado
     * ✅ ACTUALIZADO: Límites a 56 meses para alerta crítica (4 años 8 meses)
     */
    public function show(Contrato $contrato): View
    {
        // Verificar permiso
        if (!auth()->user()->can('view.contratos')) {
            abort(403, 'No tienes permiso para ver contratos.');
        }

        // Cargar relaciones
        $contrato->load('trabajador', 'adendas', 'plantilla');

        // ✅ CÁLCULO REAL DE TIEMPO ACUMULADO
        // Fecha de inicio: siempre es la del contrato original
        $fechaInicio = Carbon::parse($contrato->fecha_inicio);
        
        // Fecha de fin: depende si hay adendas o no
        $ultimaAdenda = $contrato->adendas()
            ->where('estado', '!=', 'Cancelada')
            ->orderBy('numero_adenda', 'desc')
            ->first();
        
        // Si hay adenda válida: usar su fecha_fin
        // Si no hay adenda: usar fecha_fin del contrato original
        $fechaFin = $ultimaAdenda 
            ? Carbon::parse($ultimaAdenda->fecha_fin) 
            : Carbon::parse($contrato->fecha_fin);

        // ✅ CALCULAR DIFERENCIA REAL EN MESES (con decimales)
        $meses_totales = $fechaInicio->floatDiffInMonths($fechaFin);

        // ✅ SEPARAR EN AÑOS, MESES Y DÍAS
        $años_completos = intval($meses_totales / 12); // Años completos
        $meses_restantes = intval($meses_totales % 12); // Meses después de años completos
        $dias_adicionales = round(($meses_totales - intval($meses_totales)) * 30.44); // Días decimales
        
        // Meses totales (sin años)
        $meses_acumulados = intval($meses_totales);

        // ✅ TEXTOS DESCRIPTIVOS
        // Texto 1: "X años, Y meses y Z días"
        $texto_tiempo_completo = '';
        if ($años_completos > 0) {
            $texto_tiempo_completo .= $años_completos . ' año' . ($años_completos != 1 ? 's' : '');
        }
        if ($meses_restantes > 0) {
            if ($texto_tiempo_completo != '') $texto_tiempo_completo .= ', ';
            $texto_tiempo_completo .= $meses_restantes . ' mes' . ($meses_restantes != 1 ? 'es' : '');
        }
        if ($dias_adicionales > 0) {
            if ($texto_tiempo_completo != '') $texto_tiempo_completo .= ' y ';
            $texto_tiempo_completo .= $dias_adicionales . ' día' . ($dias_adicionales != 1 ? 's' : '');
        }
        
        // Texto 2: "X meses y Y días" (solo meses totales sin años)
        $texto_meses_dias = $meses_restantes . ' mes' . ($meses_restantes != 1 ? 'es' : '');
        if ($dias_adicionales > 0) {
            $texto_meses_dias .= ' y ' . $dias_adicionales . ' día' . ($dias_adicionales != 1 ? 's' : '');
        }

        // ✅ CONTADOR DE ADENDAS VÁLIDAS (no canceladas)
        $numero_adendas = $contrato->adendas()
            ->where('estado', '!=', 'Cancelada')
            ->count();

        // ✅ DÍAS RESTANTES PRECISOS (desde HOY hasta fecha_fin)
        $ahora = now();
        
        // Calcular diferencia exacta en días (incluyendo fracciones)
        $diasExactos = $ahora->floatDiffInDays($fechaFin, false);
        
        // Si es negativo, es 0
        if ($diasExactos < 0) {
            $diasExactos = 0;
        }
        
        // Separar días enteros y horas
        $dias_para_vencer = intval($diasExactos); // Días enteros
        $fraccionDia = $diasExactos - $dias_para_vencer; // La parte decimal
        $horas_restantes = round($fraccionDia * 24); // Convertir a horas

        // ✅ DETERMINAR COLOR DE ALERTA SEGÚN MESES ACUMULADOS
        // ACTUALIZADO: Límite crítico a 56 meses (4 años 8 meses)
        // Esto deja margen de 3 meses antes del límite de 59 meses
        $color_alerta = 'blue'; // Por defecto

        if ($meses_totales >= 56) {
            // 4 años 8 meses o más = ROJO (crítico - alerta ANTES de llegar a 59)
            $color_alerta = 'red';
        } elseif ($meses_totales >= 48) {
            // 4 años o más = AMARILLO (advertencia)
            $color_alerta = 'yellow';
        }

        // ✅ TEXTO DESCRIPTIVO DE DÍAS RESTANTES
        $texto_dias_restantes = $dias_para_vencer . ' día' . ($dias_para_vencer != 1 ? 's' : '');
        if ($horas_restantes > 0) {
            $texto_dias_restantes .= ' y ' . $horas_restantes . ' hora' . ($horas_restantes != 1 ? 's' : '');
        }

        return view('contratos.show', compact(
            'contrato',
            'años_completos',           // NEW: Años completos
            'meses_restantes',          // NEW: Meses después de años
            'meses_acumulados',         // Total de meses (sin convertir a años)
            'dias_adicionales',         // Días adicionales
            'texto_tiempo_completo',    // NEW: "4 años, 6 meses y 2 días"
            'texto_meses_dias',         // NEW: "6 meses y 2 días"
            'numero_adendas',
            'dias_para_vencer',
            'horas_restantes',
            'texto_dias_restantes',
            'color_alerta'
        ));
    }

    /**
     * Mostrar formulario para editar contrato
     */
    public function edit(Contrato $contrato): View
    {
        if (!auth()->user()->can('edit.contratos')) {
            abort(403, 'No tienes permiso para editar contratos.');
        }

        $trabajadores = Trabajador::all();
        $plantillas = Plantilla::where('activa', true)->get();
        $tipos = ['Para servicio específico', 'Por incremento de actividad', 'Otros'];
        $horarios = ['8 horas', '14x7', '5x2', 'Otros'];

        return view('contratos.edit', compact('contrato', 'trabajadores', 'plantillas', 'tipos', 'horarios'));
    }

    /**
     * Actualizar datos del contrato
     */
    public function update(Request $request, Contrato $contrato): RedirectResponse
    {
        // Verificar permiso
        if (!auth()->user()->can('edit.contratos')) {
            abort(403, 'No tienes permiso para editar contratos.');
        }

        // Validar datos
        $validated = $request->validate([
            'tipo_contrato' => 'required|in:Para servicio específico,Por incremento de actividad,Otros',
            'fecha_inicio' => 'required|date|before_or_equal:fecha_fin',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'fecha_firma_manual' => 'nullable|date|before_or_equal:fecha_inicio',
            'tipo_salario' => 'required|in:Mensual,Jornal,Ambos',
            'salario_mensual' => 'nullable|numeric|min:0',
            'salario_jornal' => 'nullable|numeric|min:0',
            'horario' => 'required|in:8 horas,14x7,5x2,Otros',
            'plantilla_id' => 'nullable|exists:plantillas,id',
            'beneficios_descripcion' => 'nullable|string',
            'estado' => 'required|in:Borrador,Enviado a firmar,Firmado,Activo,Vencido,Cancelado',
        ]);

        // CALCULAR FECHA DE FIRMA MANUAL SI NO SE PROPORCIONÓ
        if (empty($validated['fecha_firma_manual'])) {
            $fechaInicio = Carbon::parse($validated['fecha_inicio']);
            $validated['fecha_firma_manual'] = $fechaInicio->copy()->subDay()->toDateString();
        }

        // Actualizar contrato
        $contrato->update($validated);

        return redirect()->route('contratos.show', $contrato->id)
                        ->with('success', '✅ Contrato actualizado exitosamente.');
    }

    /**
     * Eliminar contrato
     */
    public function destroy(Contrato $contrato): RedirectResponse
    {
        // Verificar permiso
        if (!auth()->user()->can('delete.contratos')) {
            abort(403, 'No tienes permiso para eliminar contratos.');
        }

        // Eliminar archivo firmado si existe
        if ($contrato->url_documento_escaneado && Storage::disk('public')->exists($contrato->url_documento_escaneado)) {
            Storage::disk('public')->delete($contrato->url_documento_escaneado);
        }

        $contrato->delete();

        return redirect()->route('contratos.index')
                        ->with('success', '✅ Contrato eliminado exitosamente.');
    }

    /**
     * ✅ Generar y descargar PDF del contrato
     */
    public function generarPDF(Contrato $contrato)
    {
        try {
            // Cargar relaciones
            $contrato->load('trabajador', 'plantilla');

            // Verificar que exista plantilla
            if (!$contrato->plantilla) {
                return back()->with('error', '❌ El contrato no tiene plantilla asignada.');
            }

            // OBTENER CONFIGURACIÓN DE LA EMPRESA
            $configuracion = \App\Models\ConfiguracionEmpresa::obtener();

            // ✅ USAR blade_template DIRECTAMENTE DE LA PLANTILLA
            $nombrePlantilla = $contrato->plantilla->blade_template ?? 'contratos.templates.patron-a';

            // Array de meses
            $meses = [
                1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
            ];

            // Generar $bgData
            $bgPath = base_path('public/img/fondo_page-0001.jpg');
            $bgData = '';
            if (file_exists($bgPath)) {
                $bgData = base64_encode(file_get_contents($bgPath));
            }

            // Función para convertir números a letras
            $numeroEnLetras = function($num) {
                $unidades = array(
                    0 => 'cero', 1 => 'uno', 2 => 'dos', 3 => 'tres', 4 => 'cuatro',
                    5 => 'cinco', 6 => 'seis', 7 => 'siete', 8 => 'ocho', 9 => 'nueve',
                    10 => 'diez', 11 => 'once', 12 => 'doce', 13 => 'trece', 14 => 'catorce',
                    15 => 'quince', 16 => 'dieciséis', 17 => 'diecisiete', 18 => 'dieciocho',
                    19 => 'diecinueve', 20 => 'veinte', 21 => 'veintiuno', 22 => 'veintidós',
                    23 => 'veintitrés', 24 => 'veinticuatro', 25 => 'veinticinco', 26 => 'veintiséis',
                    27 => 'veintisiete', 28 => 'veintiocho', 29 => 'veintinueve', 30 => 'treinta',
                    31 => 'treinta y uno'
                );
                return $unidades[$num] ?? (string)$num;
            };

            // Obtener código automático del contrato
            $codigoContrato = $contrato->codigo_contrato ?? $contrato->numero_contrato;
            
            // Obtener fecha de firma
            $fechaFirma = $contrato->fecha_firma_real ?? $contrato->fecha_inicio->copy()->subDay();

            // ✅ DETERMINAR TEXTO DINÁMICO DE RETRIBUCIÓN
            $tipoSalario = $contrato->tipo_salario;
            $textoRetribucion = '';
            
            if ($tipoSalario === 'Mensual') {
                $salarioMensual = $contrato->salario_mensual ?? 0;
                $textoRetribucion = "El trabajador percibirá como contraprestación por los servicios prestados un Sueldo Mensual de S/. " 
                    . number_format($salarioMensual, 2) 
                    . " (" . strtoupper($numeroEnLetras(intval($salarioMensual))) . " soles), monto que le será abonado en forma mensual.";
            } elseif ($tipoSalario === 'Jornal') {
                $salarioJornal = $contrato->salario_jornal ?? 0;
                $textoRetribucion = "El trabajador percibirá como contraprestación por los servicios prestados un Jornal diario de S/. " 
                    . number_format($salarioJornal, 2) 
                    . " (" . strtoupper($numeroEnLetras(intval($salarioJornal))) . " soles), monto que le será abonado en forma mensual.";
            }

            // PREPARAR DATOS
            $data = [
                'contrato' => $contrato,
                'trabajador' => $contrato->trabajador,
                'plantilla' => $contrato->plantilla,
                'configuracion' => $configuracion,
                'meses' => $meses,
                'dia_numero' => $fechaFirma->day,
                'dia_letra' => $numeroEnLetras($fechaFirma->day),
                'mes' => $meses[$fechaFirma->month],
                'year' => $fechaFirma->year,
                'bgData' => $bgData,
                'codigoContrato' => $codigoContrato,
                'textoRetribucion' => $textoRetribucion,
                'tipoSalario' => $tipoSalario,
            ];

            // Generar PDF
            $pdf = Pdf::loadView($nombrePlantilla, $data)
                ->setPaper('a4')
                ->setOption('margin-top', 0)
                ->setOption('margin-bottom', 0)
                ->setOption('margin-left', 0)
                ->setOption('margin-right', 0);

            $nombreArchivo = 'CONTRATO_' . $contrato->numero_contrato . '_' . $contrato->trabajador->nombre_completo . '.pdf';
            
            return $pdf->download($nombreArchivo);

        } catch (\Exception $e) {
            return back()->with('error', '❌ Error al generar PDF: ' . $e->getMessage());
        }
    }

    /**
     * ✅ Subir contrato firmado (PDF escaneado)
     */
    public function subirContratoFirmado(Request $request, Contrato $contrato): RedirectResponse
    {
        // Verificar permiso
        if (!auth()->user()->can('edit.contratos')) {
            abort(403, 'No tienes permiso para subir contratos firmados.');
        }

        // Validar archivo
        $validated = $request->validate([
            'contrato_firmado' => 'required|file|mimes:pdf|max:10240',
        ], [
            'contrato_firmado.required' => 'Debe seleccionar el contrato firmado escaneado',
            'contrato_firmado.file' => 'El archivo debe ser un archivo válido',
            'contrato_firmado.mimes' => 'El archivo debe ser PDF',
            'contrato_firmado.max' => 'El archivo no puede exceder 10MB',
        ]);

        // Procesar archivo
        if ($request->hasFile('contrato_firmado')) {
            $file = $request->file('contrato_firmado');
            
            // Eliminar archivo anterior si existe
            if ($contrato->url_documento_escaneado && Storage::disk('public')->exists($contrato->url_documento_escaneado)) {
                Storage::disk('public')->delete($contrato->url_documento_escaneado);
            }
            
            // Generar nombre único
            $nombreArchivo = 'contrato_firmado_' 
                . $contrato->numero_contrato 
                . '_' . time() 
                . '.pdf';
            
            // Guardar archivo
            $rutaArchivo = $file->storeAs('contratos/firmados', $nombreArchivo, 'public');

            // Actualizar contrato
            $contrato->update([
                'url_documento_escaneado' => $rutaArchivo,
                'estado' => 'Activo',
                'fecha_firma' => now(),
            ]);

            return redirect()->route('contratos.show', $contrato->id)
                ->with('success', '✅ Contrato firmado subido correctamente. Estado actualizado a "Firmado".');
        }

        return back()->with('error', '❌ No se pudo procesar el archivo.');
    }

    /**
     * ✅ Descargar contrato firmado escaneado
     */
    public function descargarContratoFirmado(Contrato $contrato)
    {
        // Verificar permiso
        if (!auth()->user()->can('view.contratos')) {
            abort(403, 'No tienes permiso para descargar archivos.');
        }

        // Verificar que el archivo existe
        if (!$contrato->url_documento_escaneado || !Storage::disk('public')->exists($contrato->url_documento_escaneado)) {
            return back()->with('error', '❌ No hay contrato firmado disponible para descargar.');
        }

        // Descargar con nombre descriptivo
        $nombreArchivo = 'CONTRATO_FIRMADO_' 
            . $contrato->numero_contrato 
            . '_' . $contrato->trabajador->nombre_completo 
            . '.pdf';

        return Storage::disk('public')->download($contrato->url_documento_escaneado, $nombreArchivo);
    }

    /**
     * Renovar contrato (crear adenda)
     */
    public function renovar(Contrato $contrato)
    {
        // Verificar permiso
        if (!auth()->user()->can('create.adendas')) {
            abort(403, 'No tienes permiso para renovar contratos.');
        }

        // Redirigir al formulario de crear adenda
        return redirect()->route('adendas.create', ['contrato_id' => $contrato->id]);
    }

    /**
     * Descargar PDF del contrato
     */
    public function descargarPDF(string $ruta)
    {
        try {
            $generador = new GeneradorContratosPDF();
            return $generador->descargar($ruta);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'No se puede descargar el archivo: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Vista previa del PDF
     */
    public function previsualizarPDF(Contrato $contrato)
    {
        try {
            $trabajador = $contrato->trabajador;
            $plantilla = $contrato->plantilla_id ?? 'chungar_agua_mtp';

            $datos = [
                'contrato' => $contrato,
                'trabajador' => $trabajador,
                'meses' => [
                    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo',
                    4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
                    7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre',
                    10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                ]
            ];

            return view("contratos.templates.{$plantilla}", $datos);

        } catch (Exception $e) {
            return view('contratos.preview-error', [
                'errores' => ['Error: ' . $e->getMessage()]
            ]);
        }
    }

    /**
     * Regenerar PDF
     */
    public function regenerarPDF(Contrato $contrato)
    {
        try {
            $plantilla = $contrato->plantilla_id ?? 'chungar_agua_mtp';
            $generador = new GeneradorContratosPDF();

            $rutaPDF = $generador->regenerar($contrato, $plantilla);

            return response()->json([
                'mensaje' => 'PDF regenerado exitosamente',
                'ruta' => $rutaPDF
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error al regenerar PDF: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Listar plantillas disponibles
     */
    public function listarPlantillas()
    {
        $generador = new GeneradorContratosPDF();
        $plantillas = $generador->obtenerPlantillasDisponibles();

        return response()->json([
            'plantillas' => $plantillas,
            'total' => count($plantillas)
        ]);
    }

    /**
     * Actualizar y generar PDF
     */
    public function actualizarYGenerarPDF(Request $request, Contrato $contrato)
    {
        try {
            $validated = $request->validate([
                'cargo' => 'nullable|string',
                'salario' => 'nullable|numeric',
                'fecha_inicio' => 'nullable|date',
                'fecha_fin' => 'nullable|date',
                'tipo_salario' => 'nullable|in:Mensual,Jornal,Ambos',
                'horario' => 'nullable|in:8 horas,15x7,5x2',
                'plantilla_id' => 'nullable|string'
            ]);

            $contrato->update($validated);

            $plantilla = $validated['plantilla_id'] ?? $contrato->plantilla_id ?? 'chungar_agua_mtp';
            $generador = new GeneradorContratosPDF();
            $rutaPDF = $generador->regenerar($contrato, $plantilla);

            return response()->json([
                'mensaje' => 'Contrato actualizado y PDF regenerado',
                'contrato' => $contrato,
                'pdf_ruta' => $rutaPDF
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}