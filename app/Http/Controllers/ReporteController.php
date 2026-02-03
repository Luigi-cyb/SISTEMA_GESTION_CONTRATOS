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
            ->where('estado', 'Activo');

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
            return [
                'dni' => $contrato->trabajador->dni,
                'nombre_completo' => $contrato->trabajador->nombre_completo,
                'cargo' => $contrato->trabajador->cargo,
                'departamento' => $contrato->trabajador->area_departamento,
                'unidad' => $contrato->trabajador->unidad,
                'tipo_contrato' => $contrato->tipo_contrato,
                'fecha_inicio' => $contrato->fecha_inicio,
                'fecha_fin' => $contrato->fecha_fin,
                'meses_acumulados' => $contrato->calcularMesesAcumulados(),
                'años_meses' => $this->formatearTiempo($contrato->calcularMesesAcumulados()),
                'estado' => $contrato->estado,
                'indicador_estabilidad' => $contrato->obtenerIndicadorEstabilidad()
            ];
        });

        // Exportar según formato solicitado
        if ($request->formato === 'excel') {
            return $this->exportarExcel($contratos, 'Contratos_Activos');
        }

        if ($request->formato === 'pdf') {
            return $this->exportarPDF($contratos, 'Contratos Activos', 'reportes.pdf.contratos_activos');
        }

        return view('reportes.contratos_activos', compact('contratos'));
    }

    /**
     * REPORTE 2: Próximos a vencer
     */
    public function proximosVencer(Request $request)
    {
        $dias = $request->dias ?? 30; // Por defecto 30 días

        $contratos = Contrato::with(['trabajador', 'adendas'])
            ->where('estado', 'Activo')
            ->whereRaw('DATEDIFF(fecha_fin, CURDATE()) <= ?', [$dias])
            ->whereRaw('DATEDIFF(fecha_fin, CURDATE()) >= 0')
            ->orderBy('fecha_fin', 'asc')
            ->get()
            ->map(function ($contrato) {
                return [
                    'dni' => $contrato->trabajador->dni,
                    'nombre_completo' => $contrato->trabajador->nombre_completo,
                    'cargo' => $contrato->trabajador->cargo,
                    'departamento' => $contrato->trabajador->departamento,
                    'unidad' => $contrato->trabajador->unidad,
                    'tipo_contrato' => $contrato->tipo_contrato,
                    'fecha_inicio' => $contrato->fecha_inicio,
                    'fecha_fin' => $contrato->fecha_fin,
                    'dias_restantes' => (int) round(now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($contrato->fecha_fin)->startOfDay(), false)),
                    'meses_acumulados' => (int) round($contrato->calcularMesesAcumulados()),
                ];
            });

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
        $departamento = $request->departamento;

        $query = Trabajador::with([
            'contratos' => function ($q) {
                $q->where('estado', 'Activo');
            }
        ]);

        if ($departamento) {
            $query->where('area_departamento', $departamento);
        }

        $trabajadores = $query->get()->map(function ($trabajador) {
            $contratoActivo = $trabajador->contratos->first();
            return [
                'dni' => $trabajador->dni,
                'nombre_completo' => $trabajador->nombre_completo,
                'cargo' => $trabajador->cargo,
                'departamento' => $trabajador->area_departamento,
                'unidad' => $trabajador->unidad,
                'tipo_contrato' => $contratoActivo->tipo_contrato ?? 'N/A',
                'fecha_inicio' => $contratoActivo->fecha_inicio ?? 'N/A',
                'fecha_fin' => $contratoActivo->fecha_fin ?? 'N/A',
                'meses_acumulados' => $contratoActivo ? $contratoActivo->calcularMesesAcumulados() : 0,
                'estado' => $contratoActivo->estado ?? 'INACTIVO',
            ];
        });

        // Estadísticas por departamento
        $estadisticas = Trabajador::select('area_departamento as departamento', DB::raw('count(*) as total'))
            ->groupBy('area_departamento')
            ->get();

        if ($request->formato === 'excel') {
            return $this->exportarExcel($trabajadores, 'Por_Departamento');
        }

        if ($request->formato === 'pdf') {
            return $this->exportarPDF($trabajadores, 'Reporte por Departamento', 'reportes.pdf.por_departamento');
        }

        return view('reportes.por_departamento', compact('trabajadores', 'estadisticas', 'departamento'));
    }

    /**
     * REPORTE 4: Tiempo acumulado por trabajador
     */
    public function tiempoAcumulado(Request $request)
    {
        $trabajadores = Trabajador::with(['contratos', 'adendas'])
            ->get()
            ->map(function ($trabajador) {
                // Obtener el contrato más reciente (o el activo si existe)
                // Priorizamos Activo, si no hay, el último por fecha
                $contratoActivo = $trabajador->contratos->where('estado', 'Activo')->first();

                if (!$contratoActivo) {
                    $contratoActivo = $trabajador->contratos->sortByDesc('fecha_inicio')->first();
                }

                $mesesAcumulados = $contratoActivo ? $contratoActivo->calcularMesesAcumulados() : 0;

                return [
                    'dni' => $trabajador->dni,
                    'nombre_completo' => $trabajador->nombre_completo,
                    'cargo' => $trabajador->cargo,
                    'departamento' => $trabajador->area_departamento,
                    'unidad' => $trabajador->unidad,
                    'total_contratos' => $trabajador->contratos->count(),
                    'total_adendas' => $trabajador->adendas->count(),
                    'meses_acumulados' => $mesesAcumulados,
                    'años_meses' => $this->formatearTiempo($mesesAcumulados),
                    'indicador_estabilidad' => $contratoActivo ? $contratoActivo->obtenerIndicadorEstabilidad() : 'VERDE',
                    'estado' => $contratoActivo->estado ?? 'INACTIVO',
                ];
            })
            ->sortByDesc('meses_acumulados');

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
            ->whereIn('estado', ['Activo', 'Vencido', 'Firmado', 'Enviado a firmar'])
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
                    'meses_acumulados' => $mesesAcumulados,
                    'años_meses' => $this->formatearTiempo($mesesAcumulados),
                    'meses_restantes' => $mesesRestantes,
                    'indicador_estabilidad' => $contrato->obtenerIndicadorEstabilidad(),
                    'alerta' => $mesesAcumulados >= 57 ? 'CRÍTICA' : 'ADVERTENCIA'
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
     */
    private function formatearTiempo($meses)
    {
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
        $pdf = Pdf::loadView($vista, compact('data', 'titulo'))
            ->setPaper('a4', 'landscape');

        return $pdf->download($titulo . '_' . date('Y-m-d') . '.pdf');
    }
}