<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use App\Models\Contrato;
use App\Models\Trabajador;
use App\Models\Cumpleaños;
use App\Models\ListaNegra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Dashboard Principal - Redirige según rol del usuario
     * GET /dashboard
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            return $this->dashboardAdmin();
        } elseif ($user->hasRole('RRHH')) {
            return $this->dashboardRRHH();
        } elseif ($user->hasRole('Bienestar')) {
            return $this->dashboardBienestar();
        } elseif ($user->hasRole('Gerencia')) {
            return $this->dashboardGerencia();
        }

        abort(403, 'No tienes rol asignado');
    }

    /**
     * DASHBOARD ADMIN - Vista general completa
     */
    private function dashboardAdmin()
    {
        $data = [
            // Estadísticas generales
            'totalTrabajadores' => Trabajador::where('estado', 'Activo')->count(),
            'totalContratos' => Contrato::where('estado', 'Activo')->count(),
            'totalAlertasPendientes' => Alerta::where('estado', 'Pendiente')->count(),
            'totalAlertasCriticas' => Alerta::where('estado', 'Pendiente')
                ->where('prioridad', 'Crítica')->count(),
            'totalEnListaNegra' => ListaNegra::where('estado', 'Bloqueado')->count(),

            // Contratos por tipo
            'contratosPorTipo' => Contrato::where('estado', 'Activo')
                ->groupBy('tipo_contrato')
                ->selectRaw('tipo_contrato, COUNT(*) as cantidad')
                ->get(),

            // Trabajadores por unidad
            'trabajadoresPorUnidad' => Trabajador::where('estado', 'Activo')
                ->groupBy('unidad')
                ->selectRaw('unidad, COUNT(*) as cantidad')
                ->get(),

            // Próximos vencimientos (30 días)
            'proximosVencimientos' => Contrato::where('estado', 'Activo')
                ->whereBetween('fecha_fin', [now(), now()->addDays(30)])
                ->with('trabajador')
                ->orderBy('fecha_fin')
                ->limit(10)
                ->get(),

            // Alertas críticas pendientes
            'alertasCriticas' => Alerta::where('estado', 'Pendiente')
                ->where('prioridad', 'Crítica')
                ->with('trabajador')
                ->orderBy('fecha_alerta', 'desc')
                ->limit(10)
                ->get(),

            // Trabajadores próximos a 5 años
            'proximosEstables' => $this->obtenerProximosEstables(),
        ];

        return view('dashboards.admin', $data);
    }

    /**
     * DASHBOARD RRHH - Gestión de contratos y alertas
     */
    private function dashboardRRHH()
    {
        $data = [
            // Estadísticas RRHH
            'totalContratos' => Contrato::where('estado', 'Activo')->count(),
            'contratosPor3Meses' => Contrato::where('estado', 'Activo')
                ->where('tipo_contrato', 'Temporal')
                ->count(),
            'contratosIndefinidos' => Contrato::where('estado', 'Activo')
                ->where('tipo_contrato', 'Indefinido')
                ->count(),
            'practicantes' => Contrato::where('estado', 'Activo')
                ->where('tipo_contrato', 'Practicante')
                ->count(),

            // Alertas de RRHH
            'alertasVencimiento' => Alerta::where('estado', 'Pendiente')
                ->where('tipo', 'Vencimiento de contrato')
                ->with('trabajador')
                ->orderBy('fecha_alerta', 'desc')
                ->limit(10)
                ->get(),

            'alertasEstabilidad' => Alerta::where('estado', 'Pendiente')
                ->where('tipo', 'Estabilidad laboral (5 años)')
                ->with('trabajador')
                ->orderBy('fecha_alerta', 'desc')
                ->limit(10)
                ->get(),

            // Próximos vencimientos (30 días)
            'proximosVencimientos' => Contrato::where('estado', 'Activo')
                ->whereBetween('fecha_fin', [now(), now()->addDays(30)])
                ->with('trabajador')
                ->orderBy('fecha_fin')
                ->limit(15)
                ->get(),

            // Trabajadores en lista negra
            'enListaNegra' => ListaNegra::where('estado', 'Bloqueado')
                ->with('trabajador')
                ->limit(10)
                ->get(),

            // Trabajadores próximos a 5 años
            'proximosEstables' => $this->obtenerProximosEstables(),

            // Conteos totales
            'totalAlertas' => Alerta::where('estado', 'Pendiente')
                ->whereIn('tipo', ['Vencimiento de contrato', 'Estabilidad laboral (5 años)'])
                ->count(),
            'totalEnListaNegra' => ListaNegra::where('estado', 'Bloqueado')->count(),
        ];

        return view('dashboards.rrhh', $data);
    }

    /**
     * DASHBOARD BIENESTAR - Cumpleaños y giftcards
     */
    private function dashboardBienestar()
    {
        // Próximos cumpleaños (próximos 30 días)
        $hoy = Carbon::now();
        $fechaFin = $hoy->copy()->addDays(30);

        $proximosCumpleaños = Trabajador::where('estado', 'Activo')
            ->get()
            ->filter(function ($trabajador) use ($hoy, $fechaFin) {
                if (!$trabajador->fecha_nacimiento) return false;
                
                $proximoCumpleaños = Carbon::parse($trabajador->fecha_nacimiento)
                    ->setYear($hoy->year);
                
                if ($proximoCumpleaños < $hoy) {
                    $proximoCumpleaños->addYear();
                }
                
                return $proximoCumpleaños >= $hoy && $proximoCumpleaños <= $fechaFin;
            })
            ->values();

        $data = [
            'totalTrabajadores' => Trabajador::where('estado', 'Activo')->count(),
            'proximosCumpleaños' => $proximosCumpleaños->take(20),
            'totalProximos' => $proximosCumpleaños->count(),

            // Alertas de cumpleaños
            'alertasCumpleaños' => Alerta::where('estado', 'Pendiente')
                ->where('tipo', 'Cumpleaños')
                ->with('trabajador')
                ->orderBy('fecha_alerta', 'desc')
                ->limit(15)
                ->get(),

            // Giftcards pendientes
            'giftcardsPendientes' => Cumpleaños::where('giftcard_entregada', false)
                ->with('trabajador')
                ->orderBy('fecha_cumpleaños')
                ->limit(10)
                ->get(),

            // Giftcards entregadas este mes
            'giftcardsEntregadasMes' => Cumpleaños::whereMonth('fecha_entrega_giftcard', now()->month)
    ->whereYear('fecha_entrega_giftcard', now()->year)
                ->where('giftcard_entregada', true)
                ->count(),

            'totalAlertas' => Alerta::where('estado', 'Pendiente')
                ->where('tipo', 'Cumpleaños')
                ->count(),
        ];

        return view('dashboards.bienestar', $data);
    }

    /**
     * DASHBOARD GERENCIA - Reportes y alertas críticas
     */
    private function dashboardGerencia()
    {
        $data = [
            // Estadísticas generales
            'totalTrabajadores' => Trabajador::where('estado', 'Activo')->count(),
            'totalContratos' => Contrato::where('estado', 'Activo')->count(),
            'totalPracticantes' => Contrato::where('estado', 'Activo')
                ->where('tipo_contrato', 'Practicante')
                ->count(),
            'totalIndefinidos' => Contrato::where('estado', 'Activo')
                ->where('tipo_contrato', 'Indefinido')
                ->count(),

            // Solo alertas CRÍTICAS
            'alertasCriticas' => Alerta::where('estado', 'Pendiente')
                ->where('prioridad', 'Crítica')
                ->with('trabajador', 'contrato')
                ->orderBy('fecha_alerta', 'desc')
                ->limit(15)
                ->get(),

            'totalAlertasCriticas' => Alerta::where('estado', 'Pendiente')
                ->where('prioridad', 'Crítica')
                ->count(),

            // Trabajadores próximos a 5 años (CRÍTICO)
            'proximosEstables' => $this->obtenerProximosEstables(),

            // Contrato por tipo (para gráfico)
            'contratosPorTipo' => Contrato::where('estado', 'Activo')
                ->groupBy('tipo_contrato')
                ->selectRaw('tipo_contrato, COUNT(*) as cantidad')
                ->get(),

            // Trabajadores por departamento
            'trabajadoresPorDepartamento' => Trabajador::where('estado', 'Activo')
    ->groupBy('area_departamento')
    ->selectRaw('area_departamento, COUNT(*) as cantidad')
    ->get(),
        ];

        return view('dashboards.gerencia', $data);
    }

    /**
     * Método auxiliar: Obtener trabajadores próximos a 5 años
     */
    private function obtenerProximosEstables()
    {
        $contratos = Contrato::where('estado', 'Activo')
            ->with('trabajador')
            ->get()
            ->filter(function ($contrato) {
                $mesesAcumulados = Carbon::parse($contrato->fecha_inicio)
                    ->diffInMonths(now());
                
                // Retorna contratos entre 54-60 meses (4 años 6 meses - 5 años)
                return $mesesAcumulados >= 54 && $mesesAcumulados < 61;
            })
            ->map(function ($contrato) {
                $mesesAcumulados = Carbon::parse($contrato->fecha_inicio)
                    ->diffInMonths(now());
                $contrato->meses_acumulados = $mesesAcumulados;
                $contrato->meses_restantes = 60 - $mesesAcumulados;
                return $contrato;
            })
            ->sortBy('meses_restantes')
            ->values();

        return $contratos;
    }

    /**
     * Obtener estadísticas en JSON (para AJAX/Charts)
     * GET /api/dashboard/estadisticas
     */
    public function estadisticas()
    {
        $user = Auth::user();

        if ($user->hasRole('RRHH')) {
            $data = [
                'contratosPorTipo' => Contrato::where('estado', 'Activo')
                    ->groupBy('tipo_contrato')
                    ->selectRaw('tipo_contrato as nombre, COUNT(*) as cantidad')
                    ->get(),

                'alertasPorTipo' => Alerta::where('estado', 'Pendiente')
                    ->whereIn('tipo', ['Vencimiento de contrato', 'Estabilidad laboral (5 años)'])
                    ->groupBy('tipo')
                    ->selectRaw('tipo as nombre, COUNT(*) as cantidad')
                    ->get(),

                'alertasPorPrioridad' => Alerta::where('estado', 'Pendiente')
                    ->groupBy('prioridad')
                    ->selectRaw('prioridad as nombre, COUNT(*) as cantidad')
                    ->get(),
            ];
        } elseif ($user->hasRole('Gerencia')) {
            $data = [
                'contratosPorTipo' => Contrato::where('estado', 'Activo')
                    ->groupBy('tipo_contrato')
                    ->selectRaw('tipo_contrato as nombre, COUNT(*) as cantidad')
                    ->get(),

                'trabajadoresPorDepartamento' => Trabajador::where('estado', 'Activo')
    ->groupBy('area_departamento')
    ->selectRaw('area_departamento, COUNT(*) as cantidad')
                    ->get(),
            ];
        } else {
            $data = [];
        }

        return response()->json($data);
    }
}