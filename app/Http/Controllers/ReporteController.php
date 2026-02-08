<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Models\Contrato;
use App\Models\Adenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportesExport;
use Carbon\Carbon;

class ReporteController extends Controller
{
    /**
     * Mostrar vista principal de reportes
     */
    public function index()
    {
        return view('reportes.index');
    }

    /**
     * REPORTE 1: Contratos activos con tiempo en empresa
     */
    public function contratosActivos(Request $request)
    {
        $query = Contrato::with(['trabajador', 'adendas'])
            ->where(function ($q) {
                $q->where('estado', 'Activo')
                    ->orWhereHas('adendas');
            });

        // Filtros opcionales
        if ($request->filled('departamento')) {
            $query->whereHas('trabajador', function ($q) use ($request) {
                $q->where('area_departamento', $request->departamento);
            });
        }

        if ($request->filled('unidad')) {
            $query->whereHas('trabajador', function ($q) use ($request) {
                $q->where('unidad', $request->unidad);
            });
        }

        if ($request->filled('tipo_contrato')) {
            $query->where('tipo_contrato', $request->tipo_contrato);
        }

        $contratos = $query->get()->map(function ($contrato) {
            // Obtener fecha fin real (considerando adendas)
            $ultimaAdenda = $contrato->adendas
                ->where('estado', '!=', 'Cancelada')
                ->sortByDesc('numero_adenda')
                ->first();

            $fechaFinReal = $ultimaAdenda ? $ultimaAdenda->fecha_fin : $contrato->fecha_fin;

            return [
                'dni' => $contrato->trabajador->dni,
                'nombre_completo' => $contrato->trabajador->nombre_completo,
                'cargo' => $contrato->trabajador->cargo,
                'departamento' => $contrato->trabajador->area_departamento,
                'unidad' => $contrato->trabajador->unidad,
                'tipo_contrato' => $contrato->tipo_contrato,
                'fecha_inicio' => $contrato->fecha_inicio,
                'fecha_fin' => $fechaFinReal,
                'meses_acumulados' => round($contrato->calcularMesesAcumulados()),
                'años_meses' => $contrato->calcularTiempoExacto(),
                'estado' => $contrato->estado,
                'indicador_estabilidad' => $contrato->obtenerIndicadorEstabilidad()
            ];
        });

        // Obtener listas para filtros dinámicos
        $departamentos = Trabajador::whereNotNull('area_departamento')
            ->distinct()
            ->orderBy('area_departamento')
            ->pluck('area_departamento');

        $unidades = Trabajador::whereNotNull('unidad')
            ->distinct()
            ->orderBy('unidad')
            ->pluck('unidad');

        $tiposContrato = Contrato::distinct()
            ->orderBy('tipo_contrato')
            ->pluck('tipo_contrato');

        // Exportar según formato solicitado
        if ($request->formato === 'excel') {
            return $this->exportarExcel($contratos, 'Contratos_Activos');
        }

        if ($request->formato === 'pdf') {
            return $this->exportarPDF($contratos, 'Contratos Activos', 'reportes.pdf.contratos_activos');
        }

        return view('reportes.contratos_activos', compact('contratos', 'departamentos', 'unidades', 'tiposContrato'));
    }

    /**
     * REPORTE 2: Próximos a vencer
     */
    public function proximosVencer(Request $request)
    {
        $diasFiltro = $request->dias ?? 30; // Por defecto 30 días

        $contratos = Contrato::with(['trabajador', 'adendas'])
            ->where(function ($q) {
                $q->where('estado', 'Activo')
                    ->orWhereHas('adendas');
            })
            ->get()
            ->map(function ($contrato) {
                // Obtener la fecha de fin real (considerando adendas)
                $ultimaAdenda = $contrato->adendas
                    ->where('estado', '!=', 'Cancelada')
                    ->sortByDesc('numero_adenda')
                    ->first();

                $fechaFinReal = $ultimaAdenda ? Carbon::parse($ultimaAdenda->fecha_fin) : Carbon::parse($contrato->fecha_fin);
                // Usar startOfDay para comparar días calendarios exactos
                $diasRestantes = (int) now()->startOfDay()->diffInDays($fechaFinReal->startOfDay(), false);
                $mesesAcumulados = $contrato->calcularMesesAcumulados();

                return [
                    'dni' => $contrato->trabajador->dni,
                    'nombre_completo' => $contrato->trabajador->nombre_completo,
                    'cargo' => $contrato->trabajador->cargo,
                    'departamento' => $contrato->trabajador->area_departamento,
                    'unidad' => $contrato->trabajador->unidad,
                    'tipo_contrato' => $contrato->tipo_contrato,
                    'fecha_inicio' => $contrato->fecha_inicio,
                    'fecha_fin' => $fechaFinReal->toDateString(),
                    'dias_restantes' => $diasRestantes,
                    'meses_acumulados' => round($mesesAcumulados),
                    'tiempo_formateado' => $contrato->calcularTiempoExacto()
                ];
            })
            ->filter(function ($item) use ($diasFiltro) {
                // Filtrar por el rango de días solicitado y que no hayan vencido ya
                return $item['dias_restantes'] <= $diasFiltro && $item['dias_restantes'] >= 0;
            })
            ->sortBy('dias_restantes')
            ->values();

        $dias = $diasFiltro;

        if ($request->formato === 'excel') {
            return $this->exportarExcel($contratos, 'Proximos_a_Vencer');
        }

        if ($request->formato === 'pdf') {
            return $this->exportarPDF($contratos, 'Contratos Próximos a Vencer', 'reportes.pdf.proximos_vencer');
        }

        return view('reportes.proximos_vencer', compact('contratos', 'dias'));
    }

    /**
     * REPORTE 3: Por departamento
     */
    public function porDepartamento(Request $request)
    {
        $departamentoFiltro = $request->departamento;

        // Solo trabajadores que su estado sea Activo
        $query = Trabajador::where('estado', 'Activo')
            ->with([
                'contratos' => function ($q) {
                    $q->orderBy('fecha_fin', 'desc');
                },
                'adendas'
            ]);

        if ($departamentoFiltro) {
            $query->where('area_departamento', $departamentoFiltro);
        }

        $trabajadores = $query->get()->map(function ($trabajador) {
            $contratoActivo = $trabajador->contratos->first();

            // Buscar fecha fin real considerando adendas
            $ultimaAdenda = $trabajador->adendas
                ->where('estado', '!=', 'Cancelada')
                ->sortByDesc('numero_adenda')
                ->first();

            $fechaFinReal = $ultimaAdenda ? $ultimaAdenda->fecha_fin : ($contratoActivo ? $contratoActivo->fecha_fin : 'N/A');
            $meses = $contratoActivo ? $contratoActivo->calcularMesesAcumulados() : 0;

            return [
                'dni' => $trabajador->dni,
                'nombre_completo' => $trabajador->nombre_completo,
                'cargo' => $trabajador->cargo,
                'departamento' => $trabajador->area_departamento,
                'unidad' => $trabajador->unidad,
                'tipo_contrato' => $contratoActivo->tipo_contrato ?? 'N/A',
                'fecha_inicio' => $contratoActivo ? $contratoActivo->fecha_inicio : 'N/A',
                'fecha_fin' => $fechaFinReal,
                'meses_acumulados' => round($meses),
                'tiempo_formateado' => $contratoActivo ? $contratoActivo->calcularTiempoExacto() : '0 meses',
                'estado' => $contratoActivo ? $contratoActivo->estado : 'Inactivo',
                'indicador_estabilidad' => $contratoActivo ? $contratoActivo->obtenerIndicadorEstabilidad() : 'VERDE',
            ];
        });

        // Estadísticas por departamento (solo de activos)
        $estadisticas = Trabajador::where('estado', 'Activo')
            ->select('area_departamento as departamento', DB::raw('count(*) as total'))
            ->groupBy('area_departamento')
            ->get();

        // Lista de departamentos para el filtro
        $departamentos = Trabajador::whereNotNull('area_departamento')
            ->distinct()
            ->orderBy('area_departamento')
            ->pluck('area_departamento');

        if ($request->formato === 'excel') {
            return $this->exportarExcel($trabajadores, 'Trabajadores_por_Departamento');
        }

        if ($request->formato === 'pdf') {
            return $this->exportarPDF($trabajadores, 'Reporte de Personal por Departamento', 'reportes.pdf.por_departamento');
        }

        return view('reportes.por_departamento', compact('trabajadores', 'estadisticas', 'departamentos', 'departamentoFiltro'));
    }

    /**
     * REPORTE 4: Tiempo acumulado por trabajador
     */
    public function tiempoAcumulado(Request $request)
    {
        $trabajadores = Trabajador::where('estado', 'Activo')
            ->with(['contratos', 'adendas'])
            ->get()
            ->map(function ($trabajador) {
                // Obtener el contrato más reciente para calcular el tiempo acumulado
                $contratoActivo = $trabajador->contratos()
                    ->orderBy('fecha_fin', 'desc')
                    ->first();

                $mesesAcumulados = $contratoActivo ? $contratoActivo->calcularMesesAcumulados() : 0;

                return [
                    'dni' => $trabajador->dni,
                    'nombre_completo' => $trabajador->nombre_completo,
                    'cargo' => $trabajador->cargo,
                    'departamento' => $trabajador->area_departamento,
                    'unidad' => $trabajador->unidad,
                    'total_contratos' => $trabajador->contratos->count(),
                    'total_adendas' => $trabajador->adendas->count(),
                    'fecha_inicio' => $contratoActivo ? $contratoActivo->fecha_inicio : 'N/A',
                    'meses_acumulados' => round($mesesAcumulados),
                    'años_meses' => $contratoActivo ? $contratoActivo->calcularTiempoExacto() : '0 meses',
                    'indicador_estabilidad' => $contratoActivo ? $contratoActivo->obtenerIndicadorEstabilidad() : 'VERDE',
                    'estado' => $contratoActivo->estado ?? 'Activo',
                ];
            })
            ->sortByDesc('meses_acumulados')
            ->values();

        if ($request->formato === 'excel') {
            return $this->exportarExcel($trabajadores, 'Tiempo_Acumulado');
        }

        if ($request->formato === 'pdf') {
            return $this->exportarPDF($trabajadores, 'Tiempo Acumulado por Trabajador', 'reportes.pdf.tiempo_acumulado');
        }

        return view('reportes.tiempo_acumulado', compact('trabajadores'));
    }

    /**
     * REPORTE 5: Próximos a ser estables (< 2 meses para 5 años) - CRÍTICO
     */
    public function proximosEstables(Request $request)
    {
        $trabajadores = Contrato::with(['trabajador', 'adendas'])
            ->where(function ($q) {
                $q->where('estado', 'Activo')
                    ->orWhereHas('adendas');
            })
            ->get()
            ->filter(function ($contrato) {
                $meses = $contrato->calcularMesesAcumulados();
                return $meses >= 57; // 4 años 9 meses (57 meses)
            })
            ->map(function ($contrato) {
                $mesesAcumulados = $contrato->calcularMesesAcumulados();
                $mesesRestantes = 60 - $mesesAcumulados; // Faltan para 5 años
    
                return [
                    'dni' => $contrato->trabajador->dni,
                    'nombre_completo' => $contrato->trabajador->nombre_completo,
                    'cargo' => $contrato->trabajador->cargo,
                    'departamento' => $contrato->trabajador->area_departamento,
                    'unidad' => $contrato->trabajador->unidad,
                    'tipo_contrato' => $contrato->tipo_contrato,
                    'fecha_inicio' => $contrato->fecha_inicio,
                    'fecha_fin' => $contrato->fecha_fin,
                    'meses_acumulados' => round($mesesAcumulados),
                    'años_meses' => $contrato->calcularTiempoExacto(),
                    'meses_restantes' => round($mesesRestantes, 1),
                    'indicador_estabilidad' => $contrato->obtenerIndicadorEstabilidad(),
                    'alerta' => $mesesAcumulados >= 57 ? 'CRÍTICO' : 'ADVERTENCIA'
                ];
            })
            ->sortByDesc('meses_acumulados');

        if ($request->formato === 'excel') {
            return $this->exportarExcel($trabajadores, 'Proximos_Estables_CRITICO');
        }

        if ($request->formato === 'pdf') {
            return $this->exportarPDF($trabajadores, 'Próximos a ser Estables - CRÍTICO', 'reportes.pdf.proximos_estables');
        }

        return view('reportes.proximos_estables', compact('trabajadores'));
    }

    /**
     * Método auxiliar: Formatear tiempo (meses a años y meses)
     * Ahora más preciso para evitar decimales extraños
     */
    private function formatearTiempo($meses)
    {
        $meses = round($meses);
        $años = floor($meses / 12);
        $mesesRestantes = $meses % 12;

        if ($años > 0 && $mesesRestantes > 0) {
            return "{$años} año(s) y {$mesesRestantes} mes(es)";
        } elseif ($años > 0) {
            return "{$años} año(s)";
        } else {
            return "{$mesesRestantes} mes(es)";
        }
    }

    /**
     * Exportar a Excel
     */
    private function exportarExcel($data, $filename)
    {
        return Excel::download(new ReportesExport($data), $filename . '_' . date('Y-m-d') . '.xlsx');
    }

    /**
     * Exportar a PDF
     */
    private function exportarPDF($data, $titulo, $vista)
    {
        $trabajadores = $data;
        $pdf = Pdf::loadView($vista, compact('data', 'titulo', 'trabajadores'))
            ->setPaper('a4', 'landscape');

        return $pdf->download($titulo . '_' . date('Y-m-d') . '.pdf');
    }
}