<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Models\Auditoria;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Exception;

class TrabajadorController extends Controller
{
    /**
     * Consultar datos del DNI (Simulación / API)
     */
    public function consultarDni($dni): JsonResponse
    {
        if (!auth()->user()->can('create.trabajadores')) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        if (strlen($dni) !== 8) {
            return response()->json(['error' => 'El DNI debe tener 8 dígitos'], 400);
        }

        // --- OPCIÓN: API REAL (ApisNet) ---

        // --- OPCIÓN 2: Usando APIPERU.DEV (Suele dar más datos) ---

        // 1. Regístrate en https://apiperu.dev/ y pega tu token aquí:
        $token = '961e912e84e8fd46d3f12c67cd2d6386bc070880d04e3c1e532c551371cf0615';

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json'
            ])->get('https://apiperu.dev/api/dni/' . $dni);

            $data = $response->json();

            if ($response->successful() && isset($data['success']) && $data['success']) {
                $persona = $data['data'];

                // Intentar encontrar la dirección en varias llaves posibles
                $direccion = '';
                if (isset($persona['direccion_completa']))
                    $direccion = $persona['direccion_completa'];
                elseif (isset($persona['direccion']))
                    $direccion = $persona['direccion'];
                elseif (isset($persona['ubicacion']))
                    $direccion = $persona['ubicacion'];

                // Intentar encontrar fecha de nacimiento
                $fechaNac = '';
                if (isset($persona['fecha_nacimiento'])) {
                    // A veces viene como d/m/Y o Y-m-d
                    try {
                        $fechaNac = Carbon::parse(str_replace('/', '-', $persona['fecha_nacimiento']))->format('Y-m-d');
                    } catch (Exception $e) {
                        $fechaNac = $persona['fecha_nacimiento']; // Dejar tal cual si falla
                    }
                }

                return response()->json([
                    'success' => true,
                    'data' => [
                        'nombre_completo' => $persona['nombre_completo'],
                        'nacionalidad' => 'PERUANA',
                        'direccion' => $direccion,
                        'fecha_nacimiento' => $fechaNac,
                        'raw_keys' => array_keys($persona) // DEBUG: Para saber qué llaves llegaron
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'DNI no encontrado o Token inválido.'
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al conectar con ApiPeru: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Listar todos los trabajadores con filtro por estado
     */
    public function index(Request $request): View
    {
        if (!auth()->user()->can('view.trabajadores')) {
            abort(403, 'No tienes permiso para ver trabajadores.');
        }

        $search = $request->input('search', '');
        // Por defecto, filtrar por "Activo"
        $estado = $request->input('estado', 'Activo');

        $query = Trabajador::query();

        // Filtro por búsqueda (DNI, nombre, cargo, área)
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('dni', 'like', "%{$search}%")
                    ->orWhere('nombre_completo', 'like', "%{$search}%")
                    ->orWhere('cargo', 'like', "%{$search}%")
                    ->orWhere('area_departamento', 'like', "%{$search}%");
            });
        }

        // Filtro por estado
        if ($estado && $estado !== 'Todos') {
            $query->where('estado', $estado);
        }

        // NUEVO: Filtro por Unidad
        $unidad = $request->input('unidad');
        if ($unidad) {
            $query->where('unidad', $unidad);
        }

        $trabajadores = $query->paginate(15);

        // Obtener unidades para el filtro (Limpias y ordenadas)
        $unidadesBase = ['HUARON', 'CHUNGAR', 'CENTRAL', 'ALPAMARCA', 'ROMINA'];
        $unidadesDB = Trabajador::distinct()->whereNotNull('unidad')->where('unidad', '!=', '')->pluck('unidad')->toArray();
        $unidades = array_unique(array_merge($unidadesBase, $unidadesDB));
        sort($unidades);

        $estados = ['Activo', 'Inactivo', 'Suspendido', 'Todos'];

        return view('trabajadores.index', compact('trabajadores', 'unidades', 'estados', 'search', 'estado', 'unidad'));
    }

    /**
     * Mostrar formulario para crear nuevo trabajador
     */
    public function create(): View
    {
        if (!auth()->user()->can('create.trabajadores')) {
            abort(403, 'No tienes permiso para crear trabajadores.');
        }

        // Unidades Base Oficiales
        $unidadesBase = ['HUARON', 'CHUNGAR', 'CENTRAL', 'ALPAMARCA', 'ROMINA'];

        // Obtener unidades existentes en la BD (incluye personalizadas como "HOLA1")
        $unidadesDB = Trabajador::distinct()
            ->whereNotNull('unidad')
            ->where('unidad', '!=', '')
            ->pluck('unidad')
            ->toArray();

        // Fusionar, quitar duplicados y ordenar
        $unidades = array_unique(array_merge($unidadesBase, $unidadesDB));
        sort($unidades);

        return view('trabajadores.create', compact('unidades'));
    }

    /**
     * Guardar nuevo trabajador en base de datos
     */
    public function store(Request $request): RedirectResponse
    {
        if (!auth()->user()->can('create.trabajadores')) {
            abort(403, 'No tienes permiso para crear trabajadores.');
        }

        $validated = $request->validate([
            'dni' => 'required|digits:8|unique:trabajadores,dni',
            'nombre_completo' => 'required|string|max:150',
            'fecha_nacimiento' => 'required|date|before:today', // Ahora requerido
            'nacionalidad' => 'nullable|string|max:50',
            'cargo' => 'required|string|max:100',
            'area_departamento' => 'required|string|max:100', // Ahora requerido
            'unidad' => 'required|string|max:100',
            'unidad_personalizada' => 'nullable|string|max:100',
            'telefono' => 'nullable|digits:9',
            'email' => 'nullable|email|max:100',
            'direccion_actual' => 'required|string', // Ahora requerido
            'contacto_emergencia' => 'nullable|string|max:150',
            'telefono_emergencia' => 'nullable|digits:9',
            'cuenta_bancaria' => 'nullable|string|max:20',
            'cci' => 'nullable|digits:20',
            'cv' => 'nullable|file|extensions:pdf|max:5120',
            'estado' => 'required|in:Activo,Inactivo,Suspendido',
            'fecha_ingreso' => 'nullable|date|before_or_equal:today', // Ahora opcional
        ], [
            'dni.required' => 'El DNI es obligatorio.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Este DNI ya está registrado en el sistema.',
            'telefono.digits' => 'El teléfono debe tener exactamente 9 dígitos.',
            'telefono_emergencia.digits' => 'El teléfono de emergencia debe tener exactamente 9 dígitos.',
            'cci.digits' => 'El CCI debe tener exactamente 20 dígitos.',
            'unidad.required' => 'Debe seleccionar una unidad.',
            'unidad.max' => 'La unidad no puede exceder 100 caracteres.',
            'unidad_personalizada.max' => 'La unidad personalizada no puede exceder 100 caracteres.',
            'cv.file' => 'El CV debe ser un archivo.',
            'cv.extensions' => 'El CV debe ser un archivo PDF válido.',
            'cv.max' => 'El CV no debe exceder 5MB.',
        ]);

        // Si selecciona "Otra", usar el valor personalizado
        if ($request->input('unidad') === 'Otra' || $request->input('unidad') === '') {
            if (empty($request->input('unidad_personalizada'))) {
                return back()
                    ->withInput()
                    ->withErrors(['unidad' => 'Debe ingresar un nombre de unidad personalizada.']);
            }
            $validated['unidad'] = $request->input('unidad_personalizada');
        }

        // Conversión a mayúsculas
        $validated['nombre_completo'] = strtoupper($validated['nombre_completo']);
        $validated['cargo'] = strtoupper($validated['cargo']);
        $validated['unidad'] = strtoupper($validated['unidad']);

        if (!empty($validated['area_departamento'])) {
            $validated['area_departamento'] = strtoupper($validated['area_departamento']);
        }

        // Procesar CV ANTES de crear el trabajador
        if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
            try {
                $file = $request->file('cv');
                $filename = 'cv_' . $validated['dni'] . '_' . time() . '.pdf';
                $path = $file->storeAs('trabajadores/cvs', $filename, 'public');
                $validated['cv_path'] = $path;
            } catch (\Exception $e) {
                \Log::error('Error al guardar CV: ' . $e->getMessage());
            }
        }

        // Crear trabajador
        $trabajador = Trabajador::create($validated);

        // Auditoría
        Auditoria::registrar(
            'Crear Trabajador',
            'Trabajador',
            $trabajador->id,
            ['nombre' => $trabajador->nombre_completo, 'dni' => $trabajador->dni, 'unidad' => $trabajador->unidad]
        );

        return redirect()->route('trabajadores.index')
            ->with('success', 'Trabajador creado exitosamente.');
    }

    /**
     * Mostrar detalle de un trabajador
     */
    public function show(Trabajador $trabajador): View
    {
        if (!auth()->user()->can('view.trabajadores')) {
            abort(403, 'No tienes permiso para ver trabajadores.');
        }

        $trabajador->load(['contratos.adendas', 'listaNegra']);
        return view('trabajadores.show', compact('trabajador'));
    }

    /**
     * Mostrar formulario para editar trabajador
     */
    public function edit(Trabajador $trabajador): View
    {
        if (!auth()->user()->can('edit.trabajadores')) {
            abort(403, 'No tienes permiso para editar trabajadores.');
        }

        // Unidades Base Oficiales
        $unidadesBase = ['HUARON', 'CHUNGAR', 'CENTRAL', 'ALPAMARCA', 'ROMINA'];

        // Obtener unidades existentes en la BD
        $unidadesDB = Trabajador::distinct()
            ->whereNotNull('unidad')
            ->where('unidad', '!=', '')
            ->pluck('unidad')
            ->toArray();

        // Fusionar, quitar duplicados y ordenar
        $unidades = array_unique(array_merge($unidadesBase, $unidadesDB));
        sort($unidades);

        return view('trabajadores.edit', compact('trabajador', 'unidades'));
    }

    /**
     * Actualizar datos del trabajador
     */
    public function update(Request $request, Trabajador $trabajador): RedirectResponse
    {
        if (!auth()->user()->can('edit.trabajadores')) {
            abort(403, 'No tienes permiso para editar trabajadores.');
        }

        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:150',
            'fecha_nacimiento' => 'required|date|before:today', // Ahora requerido
            'nacionalidad' => 'nullable|string|max:50',
            'cargo' => 'required|string|max:100',
            'area_departamento' => 'required|string|max:100', // Ahora requerido
            'unidad' => 'required|string|max:100', // Flexible para coincidir con store
            'telefono' => 'nullable|digits:9',
            'email' => 'nullable|email|max:100',
            'direccion_actual' => 'required|string', // Ahora requerido
            'contacto_emergencia' => 'nullable|string|max:150',
            'telefono_emergencia' => 'nullable|digits:9',
            'cuenta_bancaria' => 'nullable|string|max:20',
            'cci' => 'nullable|digits:20',
            'cv' => 'nullable|file|extensions:pdf|max:5120',
            'estado' => 'required|in:Activo,Inactivo,Suspendido',
            'fecha_ingreso' => 'nullable|date|before_or_equal:today', // Ahora opcional
        ], [
            'telefono.digits' => 'El teléfono debe tener exactamente 9 dígitos.',
            'telefono_emergencia.digits' => 'El teléfono de emergencia debe tener exactamente 9 dígitos.',
            'cci.digits' => 'El CCI debe tener exactamente 20 dígitos.',
            'unidad.in' => 'La unidad seleccionada no es válida.',
            'cv.file' => 'El CV debe ser un archivo.',
            'cv.mimetypes' => 'El CV debe ser un archivo PDF válido.',
            'cv.max' => 'El CV no debe exceder 5MB.',
        ]);

        // Conversión a mayúsculas
        $validated['nombre_completo'] = strtoupper($validated['nombre_completo']);
        $validated['cargo'] = strtoupper($validated['cargo']);

        if (!empty($validated['area_departamento'])) {
            $validated['area_departamento'] = strtoupper($validated['area_departamento']);
        }

        // Procesar CV
        if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
            try {
                // Eliminar CV anterior si existe
                if ($trabajador->tieneCV()) {
                    $trabajador->eliminarCVAnterior();
                }

                $file = $request->file('cv');
                $filename = 'cv_' . $trabajador->dni . '_' . time() . '.pdf';
                $path = $file->storeAs('trabajadores/cvs', $filename, 'public');
                $validated['cv_path'] = $path;
            } catch (\Exception $e) {
                \Log::error('Error al guardar CV: ' . $e->getMessage());
            }
        }

        // Actualizar trabajador
        $trabajador->update($validated);

        // Auditoría
        Auditoria::registrar(
            'Editar Trabajador',
            'Trabajador',
            $trabajador->id,
            ['cambios' => 'Datos actualizados', 'nombre' => $trabajador->nombre_completo, 'cv' => $request->hasFile('cv') ? 'Actualizado' : 'Sin cambios']
        );

        return redirect()->route('trabajadores.show', $trabajador->dni)
            ->with('success', 'Trabajador actualizado exitosamente.' . ($request->hasFile('cv') ? ' CV actualizado.' : ''));
    }

    /**
     * Descargar CV del trabajador
     */
    public function descargarCV(Trabajador $trabajador)
    {
        if (!auth()->user()->can('view.trabajadores')) {
            abort(403, 'No tienes permiso para descargar archivos.');
        }

        if (!$trabajador->tieneCV()) {
            abort(404, 'Este trabajador no tiene CV cargado.');
        }

        $filePath = storage_path('app/public/' . $trabajador->cv_path);

        if (!file_exists($filePath)) {
            abort(404, 'El archivo del CV no existe.');
        }

        $nombreDescarga = 'CV_' . $trabajador->dni . '_' . str_replace(' ', '_', $trabajador->nombre_completo) . '.pdf';
        return response()->download($filePath, $nombreDescarga);
    }

    /**
     * Eliminar CV del trabajador
     */
    public function eliminarCV(Trabajador $trabajador): RedirectResponse
    {
        if (!auth()->user()->can('edit.trabajadores')) {
            abort(403, 'No tienes permiso para eliminar archivos.');
        }

        if ($trabajador->tieneCV()) {
            $trabajador->eliminarCVAnterior();
            $trabajador->update(['cv_path' => null]);

            Auditoria::registrar(
                'Eliminar CV',
                'Trabajador',
                $trabajador->id,
                ['nombre' => $trabajador->nombre_completo, 'dni' => $trabajador->dni]
            );

            return redirect()->route('trabajadores.show', $trabajador->dni)
                ->with('success', 'CV eliminado exitosamente.');
        }

        return redirect()->route('trabajadores.show', $trabajador->dni)
            ->with('warning', 'Este trabajador no tiene CV cargado.');
    }

    /**
     * Eliminar trabajador
     */
    public function destroy(Trabajador $trabajador): RedirectResponse
    {
        if (!auth()->user()->can('delete.trabajadores')) {
            abort(403, 'No tienes permiso para eliminar trabajadores.');
        }

        // Eliminar CV si existe
        if ($trabajador->tieneCV()) {
            $trabajador->eliminarCVAnterior();
        }

        Auditoria::registrar(
            'Eliminar Trabajador',
            'Trabajador',
            $trabajador->id,
            ['nombre' => $trabajador->nombre_completo, 'dni' => $trabajador->dni]
        );

        $trabajador->delete();

        return redirect()->route('trabajadores.index')
            ->with('success', 'Trabajador eliminado exitosamente.');
    }
}