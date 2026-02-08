<?php

namespace App\Http\Controllers;

use App\Models\Adenda;
use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use Exception;

class AdendaController extends Controller
{
    /**
     * Listar todas las adendas
     */
    public function index(Request $request): View
    {
        // Verificar permiso
        if (!auth()->user()->can('view.adendas')) {
            abort(403, 'No tienes permiso para ver adendas.');
        }

        // Búsqueda y filtros
        $search = $request->input('search');
        $estado = $request->input('estado');

        // Query base con relaciones
        $query = Adenda::with('contrato', 'trabajador');

        // Filtro: Búsqueda por DNI o Nombre
        if ($search) {
            $query->where('dni', 'like', "%{$search}%")
                ->orWhereHas('trabajador', function ($q) use ($search) {
                    $q->where('nombre_completo', 'like', "%{$search}%");
                });
        }

        // Filtro: Estado
        if ($estado) {
            $query->where('estado', $estado);
        }

        // Obtener adendas con paginación
        $adendas = $query->paginate(15);

        // Opciones de filtros
        $estados = ['Borrador', 'Enviado a firmar', 'Firmado', 'Activo', 'Vencida', 'Cancelada'];

        return view('adendas.index', compact('adendas', 'estados', 'search', 'estado'));
    }

    /**
     * Mostrar formulario para crear nueva adenda (renovación)
     * ✅ CORREGIDO: Cálculo preciso de fecha máxima basada en meses disponibles
     */
    public function create(Request $request): View
    {
        // Verificar permiso
        if (!auth()->user()->can('create.adendas')) {
            abort(403, 'No tienes permiso para crear adendas.');
        }

        // Obtener el contrato a renovar
        $contrato_id = $request->query('contrato_id');
        $contrato = Contrato::findOrFail($contrato_id);

        // ✅ NUEVO: Obtener la última adenda del contrato (si existe)
        $ultimaAdenda = Adenda::where('contrato_id', $contrato->id)
            ->orderBy('numero_adenda', 'desc')
            ->first();

        if ($ultimaAdenda) {
            // Si existe adenda anterior, fecha inicio = 1 día después de su fecha fin
            $fechaInicioDefault = Carbon::parse($ultimaAdenda->fecha_fin)->copy()->addDay();
        } else {
            // Si no existe adenda, fecha inicio = 1 día después de fecha fin del contrato
            $fechaInicioDefault = Carbon::parse($contrato->fecha_fin)->copy()->addDay();
        }

        // ✅ CÁLCULO CORRECTO: Tiempo disponible en días (precisión)
        // LÍMITE: 4 años 11 meses (59 meses) - 1 mes ANTES de los 5 años
        // ✅ USAR EL MÉTODO DEL MODELO QUE CALCULA EN TIEMPO REAL
        $tiempoActual = $contrato->calcularTiempoAcumuladoReal();
        $tiempoMaximoPermitido = 59; // 4 años 11 meses (antes de cumplir 5 años)
        $mesesDisponibles = $tiempoMaximoPermitido - $tiempoActual;

        // Convertir meses disponibles a días de forma precisa
        // 1 mes promedio = 30.44 días (365.25 / 12)
        $diasDisponibles = floor($mesesDisponibles * 30.44);
        $fechaFinMaxima = Carbon::parse($fechaInicioDefault)->copy()->addDays($diasDisponibles);

        // Fecha fin = 3 meses después de la fecha inicio (por defecto, pero respetando máximo)
        $fechaFinDefault = Carbon::parse($fechaInicioDefault)->copy()->addMonths(3);

        // Si la fecha por defecto supera el máximo, usar el máximo
        if ($fechaFinDefault > $fechaFinMaxima) {
            $fechaFinDefault = $fechaFinMaxima;
        }

        // Fecha firma = 1 día antes de la fecha inicio
        $fechaFirmaDefault = $fechaInicioDefault->copy()->subDay();

        return view('adendas.create', compact(
            'contrato',
            'ultimaAdenda',
            'fechaInicioDefault',
            'fechaFinDefault',
            'fechaFinMaxima',
            'fechaFirmaDefault',
            'tiempoActual',
            'mesesDisponibles',
            'diasDisponibles'
        ));
    }

    /**
     * Guardar nueva adenda en base de datos
     * ✅ VALIDACIÓN CRÍTICA: Evitar pasar 59 meses (4 años 11 meses)
     */
    public function store(Request $request): RedirectResponse
    {
        // Verificar permiso
        if (!auth()->user()->can('create.adendas')) {
            abort(403, 'No tienes permiso para crear adendas.');
        }

        // Validar datos
        $validated = $request->validate([
            'contrato_id' => 'required|exists:contratos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'fecha_firma' => 'required|date|before_or_equal:fecha_inicio',
        ]);

        // Obtener el contrato
        $contrato = Contrato::findOrFail($validated['contrato_id']);

        // ✅ CRÍTICO: Usar el método que calcula en tiempo REAL (no valor guardado)
        $tiempoActual = $contrato->calcularTiempoAcumuladoReal();

        // ✅ VALIDACIÓN CRÍTICA: Verificar que no exceda 59 meses
        $fechaInicio = Carbon::parse($validated['fecha_inicio']);
        $fechaFin = Carbon::parse($validated['fecha_fin']);

        // Calcular duración de esta adenda en meses
        $diasAdenda = $fechaInicio->diffInDays($fechaFin);
        $mesesAdenda = $diasAdenda / 30.44;

        // Tiempo total después de esta adenda
        $tiempoTotal = $tiempoActual + $mesesAdenda;

        // ✅ BLOQUEAR si intenta pasar 59 meses (permitir máximo 59.0, bloquer si > 59.0)
        if ($tiempoTotal > 59.0) {
            $mesesDisponibles = 59 - $tiempoActual;
            $diasDisponibles = floor($mesesDisponibles * 30.44);
            $fechaMaximaPermitida = $fechaInicio->copy()->addDays($diasDisponibles);

            return redirect()->back()
                ->withInput()
                ->with('error', '❌ ERROR CRÍTICO: La adenda propuesta haría que el trabajador supere los 4 años 11 meses (59 meses) de antigüedad. '
                    . 'Debe mantener al menos 1 mes de diferencia antes de los 5 años. '
                    . 'Máximo permitido: ' . number_format($mesesDisponibles, 2) . ' meses adicionales. '
                    . 'Fecha fin máxima permitida: ' . $fechaMaximaPermitida->format('d/m/Y'));
        }

        // Obtener el número de adenda
        $ultimo_numero = Adenda::where('contrato_id', $contrato->id)
            ->max('numero_adenda') ?? 0;
        $numero_adenda = $ultimo_numero + 1;

        // ✅ CÁLCULO CON DECIMALES: SUMAR DURACIÓN REAL DE CADA PERÍODO (INCLUYE DÍAS)

        // 1. Calcular duración del contrato original (en meses con decimales)
        $fechaInicioContrato = Carbon::parse($contrato->fecha_inicio);
        $fechaFinContrato = Carbon::parse($contrato->fecha_fin);
        $diasContrato = $fechaInicioContrato->diffInDays($fechaFinContrato);
        $mesesContrato = $diasContrato / 30.44; // Convertir días a meses (promedio)

        // 2. Sumar duración REAL de TODAS las adendas previas
        $mesesAdendas = 0;
        $adendasPrevias = Adenda::where('contrato_id', $contrato->id)
            ->where('estado', '!=', 'Cancelada')
            ->get();

        foreach ($adendasPrevias as $adenda) {
            $inicioAdenda = Carbon::parse($adenda->fecha_inicio);
            $finAdenda = Carbon::parse($adenda->fecha_fin);
            $diasAdenda = $inicioAdenda->diffInDays($finAdenda);
            $mesesAdenda = $diasAdenda / 30.44; // Convertir a meses
            $mesesAdendas += $mesesAdenda;
        }

        // 3. Calcular duración REAL de ESTA adenda
        $fechaInicioEstaAdenda = Carbon::parse($validated['fecha_inicio']);
        $fechaFinEstaAdenda = Carbon::parse($validated['fecha_fin']);
        $diasEstaAdenda = $fechaInicioEstaAdenda->diffInDays($fechaFinEstaAdenda);
        $mesesEstaAdenda = $diasEstaAdenda / 30.44; // Convertir a meses

        // 4. TOTAL = Contrato original + Adendas previas + Esta adenda
        $mesesTotales = $mesesContrato + $mesesAdendas + $mesesEstaAdenda;

        // ✅ REDONDEAR A 3 DECIMALES PARA MANTENER PRECISIÓN
        $mesesTotales = round($mesesTotales, 3);

        // Crear adenda
        $adenda = new Adenda();
        $adenda->contrato_id = $contrato->id;
        $adenda->dni = $contrato->dni;
        $adenda->numero_adenda = $numero_adenda;
        $adenda->fecha_inicio = $validated['fecha_inicio'];
        $adenda->fecha_fin = $validated['fecha_fin'];
        $adenda->fecha_firma = $validated['fecha_firma'];
        $adenda->tipo_salario = $contrato->tipo_salario;
        $adenda->salario_mensual = $contrato->salario_mensual;
        $adenda->salario_jornal = $contrato->salario_jornal;
        $adenda->horario = $contrato->horario;
        $adenda->tiempo_acumulado_total_meses = $mesesTotales;
        $adenda->numero_adenda_contrato = $contrato->numero_contrato . '-A' . $numero_adenda;
        $adenda->estado = 'Borrador';
        $adenda->created_by = auth()->id();
        $adenda->save();

        // ✅ PASO 1: Actualizar el contrato con el nuevo tiempo acumulado
        $contrato->update([
            'tiempo_acumulado_meses' => $mesesTotales,
        ]);

        // ✅ PASO 2: Cambiar estado del contrato original a "Vencido"
        $contrato->update([
            'estado' => 'Vencido',
        ]);

        // ✅ PASO 3: Si está próximo a estabilidad (56-59 meses), crear alerta crítica
        if ($mesesTotales >= 56 && $mesesTotales < 59) {
            $contrato->update([
                'alerta_estabilidad_enviada' => true,
                'fecha_alerta_estabilidad' => now(),
            ]);
        }

        // ✅ FORMATO LEGIBLE PARA EL MENSAJE
        $mesesEnteros = intval($mesesTotales);
        $diasAdicionales = round(($mesesTotales - $mesesEnteros) * 30.44);
        $textoTiempo = $mesesEnteros . ' meses';
        if ($diasAdicionales > 0) {
            $textoTiempo .= ' y ' . $diasAdicionales . ' días';
        }
        $anios = floor($mesesEnteros / 12);
        $mesesRestantes = $mesesEnteros % 12;
        $textoAnios = $anios . ' años ' . $mesesRestantes . ' meses';

        return redirect()->route('adendas.show', $adenda->id)
            ->with('success', '✅ Adenda creada exitosamente. Tiempo acumulado: ' . $textoTiempo . ' (' . $textoAnios . ').');
    }

    /**
     * Mostrar detalle de una adenda
     */
    public function show(Adenda $adenda): View
    {
        // Verificar permiso
        if (!auth()->user()->can('view.adendas')) {
            abort(403, 'No tienes permiso para ver adendas.');
        }

        // Cargar relaciones
        $adenda->load('contrato', 'trabajador', 'adendaAnterior');

        return view('adendas.show', compact('adenda'));
    }

    /**
     * Mostrar formulario para editar adenda
     */
    public function edit(Adenda $adenda): View
    {
        // Verificar permiso
        if (!auth()->user()->can('edit.adendas')) {
            abort(403, 'No tienes permiso para editar adendas.');
        }

        return view('adendas.edit', compact('adenda'));
    }

    /**
     * Actualizar datos de la adenda
     */
    public function update(Request $request, Adenda $adenda): RedirectResponse
    {
        if (!auth()->user()->can('edit.adendas')) {
            abort(403, 'No tienes permiso para editar adendas.');
        }

        $validated = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'fecha_firma' => 'required|date|before_or_equal:fecha_inicio',
            'estado' => 'required|in:Borrador,Enviado a firmar,Firmado,Activo,Vencida,Cancelada',
        ]);

        $adenda->update($validated);

        return redirect()->route('adendas.show', $adenda->id)
            ->with('success', 'Adenda actualizada exitosamente.');
    }

    /**
     * Eliminar adenda
     */
    public function destroy(Adenda $adenda): RedirectResponse
    {
        // Verificar permiso
        if (!auth()->user()->can('delete.adendas')) {
            abort(403, 'No tienes permiso para eliminar adendas.');
        }

        $contrato_id = $adenda->contrato_id;
        $adenda->delete();

        return redirect()->route('contratos.show', $contrato_id)
            ->with('success', 'Adenda eliminada exitosamente.');
    }

    /**
     * Decidir sobre estabilidad laboral (5 años)
     * Opciones: Renovar indefinido, No renovar (cese), Prórroga
     */
    public function decisionEstabilidad(Request $request, Adenda $adenda): RedirectResponse
    {
        // Verificar permiso
        if (!auth()->user()->can('edit.adendas')) {
            abort(403, 'No tienes permiso para decidir sobre estabilidad.');
        }

        $decision = $request->input('decision'); // 'indefinido', 'cese', 'prorroga'

        $contrato = $adenda->contrato;

        if ($decision === 'indefinido') {
            // Renovar como indefinido
            $contrato->update([
                'tipo_contrato' => 'Indefinido',
                'estado' => 'Activo',
            ]);
            return redirect()->route('contratos.show', $contrato->id)
                ->with('success', 'Trabajador renovado como Indefinido (ESTABLE).');
        } elseif ($decision === 'cese') {
            // No renovar - cese
            $contrato->update([
                'estado' => 'Cancelado',
            ]);
            return redirect()->route('contratos.show', $contrato->id)
                ->with('success', 'Contrato cancelado. Trabajador cesado. Puede rehire después de 1-3 meses.');
        } elseif ($decision === 'prorroga') {
            // Extender plazo para decidir después
            $contrato->update([
                'alerta_estabilidad_enviada' => false,
            ]);
            return redirect()->route('contratos.show', $contrato->id)
                ->with('success', 'Prórroga otorgada. Decisión diferida.');
        }

        return redirect()->back()->with('error', 'Decisión no válida.');
    }

    /**
     * ✅ Generar y descargar PDF de la adenda
     */
    public function generarPDF(Adenda $adenda)
    {
        // Cargar relaciones
        $adenda->load('contrato', 'trabajador');

        // Obtener configuración de la empresa
        $configuracion = \App\Models\ConfiguracionEmpresa::obtener();

        // Array de meses
        $meses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];

        // Generar $bgData (fondo de página)
        $bgPath = base_path('public/img/fondo_page-0001.jpg');
        $bgData = '';
        if (file_exists($bgPath)) {
            $bgData = base64_encode(file_get_contents($bgPath));
        }

        // ✅ CRÍTICO: Obtener la fecha_firma de la adenda
        $fechaFirma = $adenda->fecha_firma;

        if (!$fechaFirma) {
            // Si no existe, usar un día antes de fecha_inicio
            $fechaFirma = Carbon::parse($adenda->fecha_inicio)->copy()->subDay();
        } else {
            // Asegurar que sea instancia de Carbon
            $fechaFirma = Carbon::parse($fechaFirma);
        }

        // Extraer día, mes, año
        $dia_numero = (int) $fechaFirma->format('d');
        $mes_numero = (int) $fechaFirma->format('m');
        $mes = $meses[$mes_numero];
        $year = (int) $fechaFirma->format('Y');

        // Código de la adenda
        $codigoAdenda = 'AD-' . str_pad($adenda->numero_adenda, 2, '0', STR_PAD_LEFT) .
            '/' . $adenda->contrato->numero_contrato;

        // Preparar datos para la vista
        $data = [
            'adenda' => $adenda,
            'contrato' => $adenda->contrato,
            'trabajador' => $adenda->trabajador,
            'configuracion' => $configuracion,
            'meses' => $meses,
            'dia_numero' => $dia_numero,
            'mes' => $mes,
            'year' => $year,
            'bgData' => $bgData,
            'codigoAdenda' => $codigoAdenda,
        ];

        // Generar PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('adendas.pdf', $data)
            ->setPaper('a4')
            ->setOption('margin-top', 0)
            ->setOption('margin-bottom', 0)
            ->setOption('margin-left', 0)
            ->setOption('margin-right', 0);

        $nombreArchivo = 'ADENDA_AD-' . str_pad($adenda->numero_adenda, 2, '0', STR_PAD_LEFT) . '_' . $adenda->contrato->numero_contrato . '_' . $adenda->trabajador->nombre_completo . '.pdf';

        return $pdf->download($nombreArchivo);
    }

    /**
     * ✅ Subir adenda firmada (PDF escaneado)
     */
    public function subirAdendaFirmada(Request $request, Adenda $adenda): RedirectResponse
    {
        // Verificar permiso
        if (!auth()->user()->can('edit.adendas')) {
            abort(403, 'No tienes permiso para subir adendas firmadas.');
        }

        // Validar archivo
        $validated = $request->validate([
            'adenda_firmada' => 'required|file|extensions:pdf|max:10240', // 10MB máximo
        ], [
            'adenda_firmada.required' => 'Debe seleccionar la adenda firmada escaneada',
            'adenda_firmada.file' => 'El archivo debe ser un archivo válido',
            'adenda_firmada.extensions' => 'El archivo debe ser un PDF válido (extension .pdf)',
            'adenda_firmada.max' => 'El archivo no puede exceder 10MB',
        ]);

        // Procesar archivo
        if ($request->hasFile('adenda_firmada')) {
            $file = $request->file('adenda_firmada');

            // Eliminar archivo anterior si existe
            if ($adenda->url_documento_escaneado && \Illuminate\Support\Facades\Storage::disk('public')->exists($adenda->url_documento_escaneado)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($adenda->url_documento_escaneado);
            }

            // Generar nombre único
            $nombreArchivo = 'adenda_firmada_'
                . $adenda->numero_adenda_contrato
                . '_' . time()
                . '.pdf';

            // Guardar archivo en storage/app/public/adendas/firmadas
            $rutaArchivo = $file->storeAs('adendas/firmadas', $nombreArchivo, 'public');

            // Actualizar adenda
            $adenda->update([
                'url_documento_escaneado' => $rutaArchivo,
                'estado' => 'Firmado',
            ]);

            return redirect()->route('adendas.show', $adenda->id)
                ->with('success', '✅ Adenda firmada subida correctamente. Estado actualizado a "Firmado".');
        }

        return back()->with('error', '❌ No se pudo procesar el archivo.');
    }

    /**
     * ✅ Descargar adenda firmada escaneada
     */
    public function descargarAdendaFirmada(Adenda $adenda)
    {
        // Verificar permiso
        if (!auth()->user()->can('view.adendas')) {
            abort(403, 'No tienes permiso para descargar archivos.');
        }

        // Verificar que el archivo existe
        if (!$adenda->url_documento_escaneado || !\Illuminate\Support\Facades\Storage::disk('public')->exists($adenda->url_documento_escaneado)) {
            return back()->with('error', '❌ No hay adenda firmada disponible para descargar.');
        }

        // Descargar con nombre descriptivo
        $nombreArchivo = 'ADENDA_FIRMADA_AD-' . str_pad($adenda->numero_adenda, 2, '0', STR_PAD_LEFT) . '_' . $adenda->contrato->numero_contrato . '.pdf';

        return \Illuminate\Support\Facades\Storage::disk('public')->download($adenda->url_documento_escaneado, $nombreArchivo);
    }
}