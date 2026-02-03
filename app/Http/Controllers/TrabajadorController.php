<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Models\Auditoria;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TrabajadorController extends Controller
{
    /**
     * Listar todos los trabajadores
     */// En TrabajadorController.php, reemplaza el método index() por esto:

public function index(Request $request): View
{
    if (!auth()->user()->can('view.trabajadores')) {
        abort(403, 'No tienes permiso para ver trabajadores.');
    }

    $search = $request->input('search', '');

    $query = Trabajador::query();

    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('dni', 'like', "%{$search}%")
              ->orWhere('nombre_completo', 'like', "%{$search}%")
              ->orWhere('cargo', 'like', "%{$search}%")
              ->orWhere('area_departamento', 'like', "%{$search}%");
        });
    }

    $trabajadores = $query->paginate(15);
    $unidades = Trabajador::distinct()->pluck('unidad')->sort();
    $estados = ['Activo', 'Inactivo', 'Suspendido'];

    return view('trabajadores.index', compact('trabajadores', 'unidades', 'estados', 'search'));
}

    /**
     * Mostrar formulario para crear nuevo trabajador
     */
    public function create(): View
    {
        if (!auth()->user()->can('create.trabajadores')) {
            abort(403, 'No tienes permiso para crear trabajadores.');
        }

        $unidades = ['Chungar', 'Huarón', 'Romina', 'Baños', 'Alpamarca', 'Central', 'Otra'];
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
            'fecha_nacimiento' => 'nullable|date|before:today',
            'nacionalidad' => 'nullable|string|max:50',
            'cargo' => 'required|string|max:100',
            'area_departamento' => 'nullable|string|max:100',
            'unidad' => 'required|in:Chungar,Huarón,Romina,Baños,Alpamarca,Central,Otra',
            'telefono' => 'nullable|digits:9',
            'email' => 'nullable|email|max:100',
            'direccion_actual' => 'nullable|string',
            'contacto_emergencia' => 'nullable|string|max:150',
            'telefono_emergencia' => 'nullable|digits:9',
            'cuenta_bancaria' => 'nullable|string|max:20',
            'cci' => 'nullable|digits:20',
            'cv' => 'nullable|file|mimes:pdf|max:5120',
            'estado' => 'required|in:Activo,Inactivo,Suspendido',
            'fecha_ingreso' => 'required|date|before_or_equal:today',
        ], [
            'dni.required' => 'El DNI es obligatorio.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Este DNI ya está registrado en el sistema.',
            'telefono.digits' => 'El teléfono debe tener exactamente 9 dígitos.',
            'telefono_emergencia.digits' => 'El teléfono de emergencia debe tener exactamente 9 dígitos.',
            'cci.digits' => 'El CCI debe tener exactamente 20 dígitos.',
            'unidad.required' => 'Debe seleccionar una unidad.',
            'unidad.in' => 'La unidad seleccionada no es válida.',
            'cv.file' => 'El CV debe ser un archivo.',
            'cv.mimes' => 'El CV debe ser un archivo PDF.',
            'cv.max' => 'El CV no debe exceder 5MB.',
        ]);

        // Conversión a mayúsculas
        $validated['nombre_completo'] = strtoupper($validated['nombre_completo']);
        $validated['cargo'] = strtoupper($validated['cargo']);
        
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
            ['nombre' => $trabajador->nombre_completo, 'dni' => $trabajador->dni, 'cv' => $request->hasFile('cv') ? 'Sí' : 'No']
        );

        return redirect()->route('trabajadores.index')
                        ->with('success', 'Trabajador creado exitosamente.' . ($request->hasFile('cv') ? ' CV cargado.' : ''));
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

        $unidades = ['Chungar', 'Huarón', 'Romina', 'Baños', 'Alpamarca', 'Central', 'Otra'];
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
            'fecha_nacimiento' => 'nullable|date|before:today',
            'nacionalidad' => 'nullable|string|max:50',
            'cargo' => 'required|string|max:100',
            'area_departamento' => 'nullable|string|max:100',
            'unidad' => 'required|in:Chungar,Huarón,Romina,Baños,Alpamarca,Central,Otra',
            'telefono' => 'nullable|digits:9',
            'email' => 'nullable|email|max:100',
            'direccion_actual' => 'nullable|string',
            'contacto_emergencia' => 'nullable|string|max:150',
            'telefono_emergencia' => 'nullable|digits:9',
            'cuenta_bancaria' => 'nullable|string|max:20',
            'cci' => 'nullable|digits:20',
            'cv' => 'nullable|file|mimes:pdf|max:5120',
            'estado' => 'required|in:Activo,Inactivo,Suspendido',
            'fecha_ingreso' => 'required|date|before_or_equal:today',
        ], [
            'telefono.digits' => 'El teléfono debe tener exactamente 9 dígitos.',
            'telefono_emergencia.digits' => 'El teléfono de emergencia debe tener exactamente 9 dígitos.',
            'cci.digits' => 'El CCI debe tener exactamente 20 dígitos.',
            'unidad.in' => 'La unidad seleccionada no es válida.',
            'cv.file' => 'El CV debe ser un archivo.',
            'cv.mimes' => 'El CV debe ser un archivo PDF.',
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