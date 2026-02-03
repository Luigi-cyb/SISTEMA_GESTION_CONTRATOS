<?php

namespace App\Http\Controllers;

use App\Models\ListaNegra;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ListaNegraController extends Controller
{
    /**
     * Mostrar lista de trabajadores en lista negra
     * GET /lista-negra
     */
    public function index(Request $request)
    {
        // Verificar permiso
        if (!Auth::user()->hasPermissionTo('view.lista_negra')) {
            abort(403, 'No tienes permiso para ver la lista negra');
        }

        // Obtener todos los registros de lista negra con trabajador relacionado
        $query = ListaNegra::with(['trabajador', 'bloqueadoPor', 'desbloqueadoPor']);

        // Filtro por estado (Bloqueado/Desbloqueado)
        if ($request->has('estado') && $request->estado != '') {
            $query->where('estado', $request->estado);
        }

        // Búsqueda por DNI
        if ($request->has('dni') && $request->dni != '') {
            $query->where('dni', 'like', '%' . $request->dni . '%');
        }

        // Búsqueda por nombre del trabajador
        if ($request->has('nombre') && $request->nombre != '') {
            $query->whereHas('trabajador', function ($q) use ($request) {
                $q->where('nombre_completo', 'like', '%' . $request->nombre . '%');
            });
        }

        // Filtro por tipo de bloqueo (motivo)
        if ($request->has('motivo') && $request->motivo != '') {
            $query->where('motivo', $request->motivo);
        }

        // Paginación
        $listaNegra = $query->paginate(15);

        return view('lista_negra.index', compact('listaNegra'));
    }

    /**
     * Mostrar formulario para agregar trabajador a lista negra
     * GET /lista-negra/create
     */
    public function create()
    {
        // Verificar permiso
        if (!Auth::user()->hasPermissionTo('create.lista_negra')) {
            abort(403, 'No tienes permiso para agregar a lista negra');
        }

        // CORREGIDO: Obtener trabajadores que NO están en lista negra o están desbloqueados
        $trabajadores = Trabajador::leftJoin('lista_negra', 'trabajadores.dni', '=', 'lista_negra.dni')
            ->where(function($query) {
                $query->whereNull('lista_negra.dni')
                      ->orWhere('lista_negra.estado', 'Desbloqueado');
            })
            ->select('trabajadores.*')
            ->orderBy('trabajadores.nombre_completo')
            ->get();

        return view('lista_negra.create', compact('trabajadores'));
    }

    /**
     * Guardar trabajador en lista negra
     * POST /lista-negra
     * 
     * CORREGIDO: Ahora cambia automáticamente el estado del trabajador a Inactivo
     */
    public function store(Request $request)
    {
        // Verificar permiso
        if (!Auth::user()->hasPermissionTo('create.lista_negra')) {
            abort(403, 'No tienes permiso para agregar a lista negra');
        }

        // Validar datos
        $validated = $request->validate([
            'dni' => 'required|exists:trabajadores,dni',
            'motivo' => 'required|in:Leve,Grave',
            'descripcion_motivo' => 'required|string|max:1000',
            'documento_informe' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB máximo
        ], [
            'dni.required' => 'El DNI es requerido',
            'dni.exists' => 'El trabajador no existe',
            'motivo.required' => 'El tipo de bloqueo es requerido',
            'motivo.in' => 'El tipo de bloqueo debe ser Leve o Grave',
            'descripcion_motivo.required' => 'La descripción del motivo es requerida',
            'descripcion_motivo.max' => 'La descripción no puede exceder 1000 caracteres',
            'documento_informe.file' => 'El documento debe ser un archivo',
            'documento_informe.mimes' => 'El documento debe ser PDF, JPG, JPEG o PNG',
            'documento_informe.max' => 'El documento no puede exceder 5MB',
        ]);

        // CORREGIDO: Verificar si ya está en lista negra (estado = Bloqueado)
        $existeActivo = ListaNegra::where('dni', $validated['dni'])
            ->where('estado', 'Bloqueado')
            ->first();

        if ($existeActivo) {
            return back()->with('error', 'Este trabajador ya está en lista negra');
        }

        // Procesar documento escaneado
        $urlDocumento = null;
        if ($request->hasFile('documento_informe')) {
            $file = $request->file('documento_informe');
            $nombreArchivo = 'lista_negra_' . $validated['dni'] . '_' . time() . '.' . $file->getClientOriginalExtension();
            $urlDocumento = $file->storeAs('lista_negra', $nombreArchivo, 'public');
        }

        // CORREGIDO: Crear registro en lista negra con campos correctos
        $puedeDesbloquear = ($validated['motivo'] === 'Leve') ? 1 : 0;
        
        $listaNegra = ListaNegra::create([
            'dni' => $validated['dni'],
            'motivo' => $validated['motivo'],
            'descripcion_motivo' => $validated['descripcion_motivo'],
            'url_informe_escaneado' => $urlDocumento,
            'puede_desbloquear' => $puedeDesbloquear,
            'bloqueado_por' => Auth::id(),
            'fecha_bloqueo' => now(),
            'estado' => 'Bloqueado',
        ]);

        // NUEVO: Cambiar estado del trabajador automáticamente a Inactivo
        // Esto activará el boot del modelo Trabajador y cambiará a "Suspendido"
        $trabajador = Trabajador::findOrFail($validated['dni']);
        $trabajador->marcarInactivo();

        return redirect()->route('lista-negra.index')
            ->with('success', 'Trabajador agregado a lista negra correctamente y marcado como Suspendido.');
    }

    /**
     * Ver detalles de un registro de lista negra
     * GET /lista-negra/{id}
     */
    public function show($id)
    {
        // Verificar permiso
        if (!Auth::user()->hasPermissionTo('view.lista_negra')) {
            abort(403, 'No tienes permiso para ver la lista negra');
        }

        $listaNegra = ListaNegra::with(['trabajador', 'bloqueadoPor', 'desbloqueadoPor'])->findOrFail($id);

        return view('lista_negra.show', compact('listaNegra'));
    }

    /**
     * Mostrar formulario para desbloquear trabajador
     * GET /lista-negra/{id}/desbloquear
     */
    public function desbloquearForm($id)
    {
        // Verificar permiso
        if (!Auth::user()->hasPermissionTo('desbloquear.lista_negra')) {
            abort(403, 'No tienes permiso para desbloquear');
        }

        $listaNegra = ListaNegra::findOrFail($id);

        // Si es Grave no se puede desbloquear
        if ($listaNegra->motivo === 'Grave') {
            return back()->with('error', 'Los bloqueos Graves no pueden ser desbloqueados');
        }

        return view('lista_negra.desbloquear', compact('listaNegra'));
    }

    /**
     * Procesar desbloqueo de trabajador
     * POST /lista-negra/{id}/desbloquear
     * 
     * CORREGIDO: Ahora valida AMBOS campos (motivo_desbloqueo y documento_carta)
     */
    public function desbloquear(Request $request, $id)
    {
        // Verificar permiso
        if (!Auth::user()->hasPermissionTo('desbloquear.lista_negra')) {
            abort(403, 'No tienes permiso para desbloquear');
        }

        $listaNegra = ListaNegra::findOrFail($id);

        // Si es Grave no se puede desbloquear
        if ($listaNegra->motivo === 'Grave') {
            return back()->with('error', 'Los bloqueos Graves no pueden ser desbloqueados');
        }

        // CORREGIDO: Validar AMBOS campos (motivo_desbloqueo y documento_carta)
        $validated = $request->validate([
            'motivo_desbloqueo' => 'required|string|max:500',
            'documento_carta' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'motivo_desbloqueo.required' => 'El motivo del desbloqueo es requerido',
            'motivo_desbloqueo.max' => 'El motivo no puede exceder 500 caracteres',
            'documento_carta.required' => 'La carta de compromiso es requerida',
            'documento_carta.file' => 'El documento debe ser un archivo',
            'documento_carta.mimes' => 'El documento debe ser PDF, JPG, JPEG o PNG',
            'documento_carta.max' => 'El documento no puede exceder 5MB',
        ]);

        // Procesar documento de carta de compromiso
        if ($request->hasFile('documento_carta')) {
            $file = $request->file('documento_carta');
            $nombreArchivo = 'carta_compromiso_' . $listaNegra->dni . '_' . time() . '.' . $file->getClientOriginalExtension();
            $urlDocumento = $file->storeAs('lista_negra/cartas_compromiso', $nombreArchivo, 'public');

            // CORREGIDO: Actualizar registro con motivo_desbloqueo y hora exacta
            $listaNegra->update([
                'url_carta_compromiso' => $urlDocumento,
                'estado' => 'Desbloqueado',
                'desbloqueado_por' => Auth::id(),
                'fecha_desbloqueo' => now(), // Ahora guarda DATETIME, no solo DATE
            ]);

            // NUEVO: Cambiar estado del trabajador automáticamente a Activo
            $trabajador = Trabajador::findOrFail($listaNegra->dni);
            $trabajador->marcarActivo();
        }

        return redirect()->route('lista-negra.index')
            ->with('success', 'Trabajador desbloqueado correctamente y marcado como Activo.');
    }

    /**
     * Verificar si un trabajador está en lista negra
     * Usado al crear contratos
     */
    public static function verificarEnListaNegra($dni)
    {
        // CORREGIDO: usar 'estado' = 'Bloqueado'
        return ListaNegra::where('dni', $dni)
            ->where('estado', 'Bloqueado')
            ->first();
    }

    /**
     * Obtener información de bloqueo para mostrar alerta
     */
    public static function obtenerInfoBloqueo($dni)
    {
        $registro = self::verificarEnListaNegra($dni);

        if ($registro) {
            return [
                'bloqueado' => true,
                'tipo' => $registro->motivo,
                'motivo' => $registro->descripcion_motivo,
                'puede_desbloquear' => $registro->puede_desbloquear,
            ];
        }

        return ['bloqueado' => false];
    }

    /**
     * Eliminar de lista negra (soft delete conceptual)
     * DELETE /lista-negra/{id}
     */
    public function destroy($id)
    {
        // Verificar permiso
        if (!Auth::user()->hasPermissionTo('delete.lista_negra')) {
            abort(403, 'No tienes permiso para eliminar');
        }

        $listaNegra = ListaNegra::findOrFail($id);
        $listaNegra->delete();

        return redirect()->route('lista-negra.index')
            ->with('success', 'Registro eliminado de lista negra');
    }
}