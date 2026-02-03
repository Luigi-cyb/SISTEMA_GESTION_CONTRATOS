<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AlertaController extends Controller
{
    /**
     * Mostrar todas las alertas del usuario autenticado
     * GET /alertas
     */
    public function index(Request $request)
    {
        // Verificar permiso
        if (!Auth::user()->hasPermissionTo('view.alertas')) {
            abort(403, 'No tienes permiso para ver alertas');
        }

        $query = Alerta::query();

        // Filtros según rol del usuario
        $user = Auth::user();

        if ($user->hasRole('RRHH')) {
            // RRHH ve: Vencimiento + Estabilidad
            $query->whereIn('tipo', ['Vencimiento de contrato', 'Estabilidad laboral (5 años)']);
        } elseif ($user->hasRole('Bienestar')) {
            // Bienestar ve: Cumpleaños
            $query->where('tipo', 'Cumpleaños');
        } elseif ($user->hasRole('Gerencia')) {
            // Gerencia ve: Solo alertas críticas
            $query->where('prioridad', 'Crítica');
        }
        // Admin ve todo

        // Filtro por estado
        if ($request->has('estado') && $request->estado != '') {
            $query->where('estado', $request->estado);
        } else {
            // Por defecto mostrar pendientes
            $query->where('estado', 'Pendiente');
        }

        // Filtro por prioridad
        if ($request->has('prioridad') && $request->prioridad != '') {
            $query->where('prioridad', $request->prioridad);
        }

        // Ordenar por prioridad (Crítica primero) y fecha
        $alertas = $query->orderByRaw("FIELD(prioridad, 'Crítica', 'Alta', 'Media', 'Baja')")
            ->orderBy('fecha_alerta', 'desc')
            ->paginate(20);

        return view('alertas.index', compact('alertas'));
    }

    /**
     * Ver detalles de una alerta
     * GET /alertas/{id}
     */
    public function show($id)
    {
        // Verificar permiso
        if (!Auth::user()->hasPermissionTo('view.alertas')) {
            abort(403, 'No tienes permiso para ver alertas');
        }

        $alerta = Alerta::findOrFail($id);

        // Marcar como leída
        if ($alerta->estado == 'Pendiente') {
            $alerta->update(['estado' => 'Leída']);
        }

        return view('alertas.show', compact('alerta'));
    }

    /**
     * Marcar alerta como resuelta
     * POST /alertas/{id}/resolver
     */
    public function resolver($id)
    {
        // Verificar permiso
        if (!Auth::user()->hasPermissionTo('edit.alertas')) {
            abort(403, 'No tienes permiso para resolver alertas');
        }

        $alerta = Alerta::findOrFail($id);

        $alerta->update([
            'estado' => 'Resuelta',
        ]);

        return redirect()->route('alertas.index')
            ->with('success', 'Alerta marcada como resuelta');
    }

    /**
     * Generar alertas manualmente (para testing)
     * POST /alertas/generar
     */
    public function generar(Request $request)
    {
        // Solo Admin y RRHH pueden ejecutar esto
        if (!Auth::user()->hasRole('Admin') && !Auth::user()->hasRole('RRHH')) {
            abort(403, 'Solo administradores y RRHH pueden generar alertas manualmente');
        }

        $tipo = $request->input('tipo'); // vencimiento, cumpleaños, estabilidad

        try {
            switch ($tipo) {
                case 'vencimiento':
                    \Illuminate\Support\Facades\Artisan::call('alertas:vencimiento');
                    $mensaje = 'Alertas de vencimiento generadas correctamente';
                    break;

                case 'cumpleaños':
                    \Illuminate\Support\Facades\Artisan::call('alertas:cumpleanos');
                    $mensaje = 'Alertas de cumpleaños generadas correctamente';
                    break;

                case 'estabilidad':
                    \Illuminate\Support\Facades\Artisan::call('alertas:estabilidad');
                    $mensaje = 'Alertas de estabilidad generadas correctamente';
                    break;

                default:
                    \Illuminate\Support\Facades\Artisan::call('alertas:vencimiento');
                    \Illuminate\Support\Facades\Artisan::call('alertas:cumpleanos');
                    \Illuminate\Support\Facades\Artisan::call('alertas:estabilidad');
                    $mensaje = 'Todas las alertas generadas correctamente';
            }

            return redirect()->back()->with('success', $mensaje);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Obtener alertas para el dashboard (JSON)
     * GET /api/alertas/dashboard
     */
    public function dashboardAlertas()
    {
        $user = Auth::user();

        $query = Alerta::where('estado', 'Pendiente');

        if ($user->hasRole('RRHH')) {
            $query->whereIn('tipo', ['Vencimiento de contrato', 'Estabilidad laboral (5 años)']);
        } elseif ($user->hasRole('Bienestar')) {
            $query->where('tipo', 'Cumpleaños');
        } elseif ($user->hasRole('Gerencia')) {
            $query->where('prioridad', 'Crítica');
        }

        $alertas = $query->orderByRaw("FIELD(prioridad, 'Crítica', 'Alta', 'Media', 'Baja')")
            ->orderBy('fecha_alerta', 'desc')
            ->limit(10)
            ->get();

        return response()->json([
            'total' => $alertas->count(),
            'criticas' => $alertas->where('prioridad', 'Crítica')->count(),
            'alertas' => $alertas,
        ]);
    }

    /**
     * Eliminar alerta (admin)
     * DELETE /alertas/{id}
     */
    public function destroy($id)
    {
        // Verificar permiso
        if (!Auth::user()->hasPermissionTo('delete.alertas')) {
            abort(403, 'No tienes permiso para eliminar alertas');
        }

        $alerta = Alerta::findOrFail($id);
        $alerta->delete();

        return redirect()->route('alertas.index')
            ->with('success', 'Alerta eliminada correctamente');
    }
}