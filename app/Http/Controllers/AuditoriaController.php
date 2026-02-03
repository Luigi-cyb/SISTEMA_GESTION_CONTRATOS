<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    /**
     * Mostrar lista de auditoría
     */
    public function index(Request $request)
    {
        $query = Auditoria::with('user')->latest('fecha');

        // Filtro por usuario
        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Filtro por acción
        if ($request->accion) {
            $query->where('accion', 'like', '%' . $request->accion . '%');
        }

        // Filtro por modelo
        if ($request->modelo) {
            $query->where('modelo', $request->modelo);
        }

        // Filtro por fecha
        if ($request->fecha_desde) {
            $query->whereDate('fecha', '>=', $request->fecha_desde);
        }

        if ($request->fecha_hasta) {
            $query->whereDate('fecha', '<=', $request->fecha_hasta);
        }

        $auditoria = $query->paginate(20);

        return view('auditoria.index', compact('auditoria'));
    }

    /**
     * Ver detalle de una acción
     */
    public function show(Auditoria $auditoria)
    {
        return view('auditoria.show', compact('auditoria'));
    }
}