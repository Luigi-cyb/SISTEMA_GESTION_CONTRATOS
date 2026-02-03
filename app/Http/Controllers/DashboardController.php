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
use App\Models\Adenda;


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
     * CORREGIDO: Cambiar de whereIn(['Firmado', 'Activo']) a where('estado', 'Activo')
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
     * CORREGIDO: Cambiar de whereIn(['Firmado', 'Activo']) a where('estado', 'Activo')
     */
    private function dashboardRRHH()
    {
        // Estadísticas RRHH CORREGIDAS
        $totalContratos = Contrato::where('estado', 'Activo')->count();
        
        $contratosPor3Meses = Contrato::where('estado', 'Activo')
            ->where('tipo_contrato', 'Para servicio específico')
            ->count();
        
        $contratosIndefinidos = Contrato::where('estado', 'Activo')
            ->where('tipo_contrato', 'Indefinido')
            ->count();
        
        $practicantes = Contrato::where('estado', 'Activo')
            ->where('tipo_contrato', 'Practicante')
            ->count();

        // Trabajadores activos/inactivos
        $trabajadoresActivos = Trabajador::where('estado', 'Activo')->count();
        $trabajadoresInactivos = Trabajador::where('estado', 'Inactivo')->count();

        $data = [
            // Estadísticas RRHH CORREGIDAS
            'totalContratos' => $totalContratos,
            'contratosPor3Meses' => $contratosPor3Meses,
            'contratosIndefinidos' => $contratosIndefinidos,
            'practicantes' => $practicantes,
            'trabajadoresActivos' => $trabajadoresActivos,
            'trabajadoresInactivos' => $trabajadoresInactivos,

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

            // Próximos vencimientos (30 días) - CORREGIDO
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
        // Sincronizar cumpleaños automáticamente
        $this->sincronizarCumpleaños();

        // Obtener TODOS los cumpleaños de trabajadores ACTIVOS (sin filtro de 30 días)
        $proximosCumpleaños = Cumpleaños::with('trabajador')
            ->whereHas('trabajador', function($query) {
                $query->where('estado', 'Activo');
            })
            ->get();

        $data = [
            'totalTrabajadores' => Trabajador::where('estado', 'Activo')->count(),
            'proximosCumpleaños' => $proximosCumpleaños,
            'totalProximos' => $proximosCumpleaños->count(),

            // Alertas de cumpleaños
            'alertasCumpleaños' => Alerta::where('estado', 'Pendiente')
                ->where('tipo', 'Cumpleaños')
                ->with('trabajador')
                ->orderBy('fecha_alerta', 'desc')
                ->limit(15)
                ->get(),

            // Giftcards pendientes (solo de ACTIVOS)
            'giftcardsPendientes' => Cumpleaños::where('giftcard_entregada', false)
                ->with('trabajador')
                ->whereHas('trabajador', function($query) {
                    $query->where('estado', 'Activo');
                })
                ->orderBy('fecha_cumpleaños')
                ->get(),

            // Giftcards entregadas este mes
            'giftcardsEntregadasMes' => Cumpleaños::whereMonth('fecha_entrega_giftcard', now()->month)
                ->whereYear('fecha_entrega_giftcard', now()->year)
                ->where('giftcard_entregada', true)
                ->whereHas('trabajador', function($query) {
                    $query->where('estado', 'Activo');
                })
                ->count(),

            'totalAlertas' => Alerta::where('estado', 'Pendiente')
                ->where('tipo', 'Cumpleaños')
                ->count(),
        ];

        return view('dashboards.bienestar', $data);
    }

    /**
     * DASHBOARD GERENCIA - Reportes y alertas críticas
     * CORREGIDO: Cambiar de whereIn(['Firmado', 'Activo']) a where('estado', 'Activo')
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

            // Contrato por tipo (para gráfico) - CORREGIDO
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
     * CORREGIDO: Cambiar de whereIn(['Firmado', 'Activo']) a where('estado', 'Activo')
     */

   private function obtenerProximosEstables()
{
    // Buscar adendas con tiempo >= 48 meses
    $adendasCriticas = Adenda::where('tiempo_acumulado_total_meses', '>=', 48)
        ->where('tiempo_acumulado_total_meses', '<', 60)
        ->with('trabajador', 'contrato')
        ->get();
    
    // Agrupar por DNI y quedarse solo con la adenda más reciente (mayor tiempo acumulado)
    $trabajadoresUnicos = [];
    
    foreach ($adendasCriticas as $adenda) {
        if (!$adenda->trabajador) {
            continue;
        }
        
        $dni = $adenda->dni;
        
        // Si no existe o tiene menos meses que la actual, actualizar
        if (!isset($trabajadoresUnicos[$dni]) || 
            $trabajadoresUnicos[$dni]->meses_acumulados < $adenda->tiempo_acumulado_total_meses) {
            
            $mesesAcumulados = $adenda->tiempo_acumulado_total_meses;
            $mesesRestantes = 60 - $mesesAcumulados;
            
            $trabajadoresUnicos[$dni] = (object) [
                'id' => $adenda->contrato_id,
                'dni' => $adenda->dni,  // ← AGREGAR ESTA LÍNEA
                'trabajador' => $adenda->trabajador,
                'meses_acumulados' => $mesesAcumulados,
                'meses_restantes' => $mesesRestantes,
                'porcentaje' => round(($mesesAcumulados / 60) * 100, 2),
            ];
        }
    }
    
    // Convertir a array y ordenar por meses restantes
    $proximosEstables = array_values($trabajadoresUnicos);
    
    usort($proximosEstables, function($a, $b) {
        return $a->meses_restantes <=> $b->meses_restantes;
    });
    
    return $proximosEstables;
}

    /**
     * Sincronizar cumpleaños automáticamente
     */
    private function sincronizarCumpleaños()
    {
        $trabajadores = Trabajador::whereNotNull('fecha_nacimiento')->get();

        foreach ($trabajadores as $trabajador) {
            $cumpleaños = Cumpleaños::where('dni', $trabajador->dni)->first();

            if (!$cumpleaños) {
                Cumpleaños::create([
                    'dni' => $trabajador->dni,
                    'fecha_cumpleaños' => $trabajador->fecha_nacimiento,
                    'giftcard_entregada' => false,
                ]);
            } else {
                if ($cumpleaños->fecha_cumpleaños !== $trabajador->fecha_nacimiento) {
                    $cumpleaños->update([
                        'fecha_cumpleaños' => $trabajador->fecha_nacimiento,
                    ]);
                }
            }
        }
    }

    /**
     * Obtener estadísticas en JSON (para AJAX/Charts)
     * GET /api/dashboard/estadisticas
     * CORREGIDO: Cambiar de whereIn(['Firmado', 'Activo']) a where('estado', 'Activo')
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