<?php

namespace App\Services;

use App\Models\Alerta;
use App\Models\Contrato;
use App\Models\Cumpleaños;
use App\Models\Trabajador;
use App\Models\Adenda;
use Carbon\Carbon;

class AlertaService
{
    /**
     * Generar alertas automáticas para cumpleaños próximos (5 días)
     */
    public static function generarAlertasCumpleaños()
    {
        $hoy = Carbon::now();
        $fechaLimite = $hoy->copy()->addDays(5);

        $cumpleaños = Cumpleaños::with('trabajador')
            ->whereHas('trabajador', function ($q) {
                $q->where('estado', 'Activo');
            })
            ->where('giftcard_entregada', false)
            ->get()
            ->filter(function ($cumple) use ($hoy, $fechaLimite) {
                if (!$cumple->fecha_cumpleaños)
                    return false;

                $proximoCumpleaños = Carbon::parse($cumple->fecha_cumpleaños)
                    ->setYear($hoy->year);

                if ($proximoCumpleaños < $hoy) {
                    $proximoCumpleaños->addYear();
                }

                return $proximoCumpleaños >= $hoy && $proximoCumpleaños <= $fechaLimite;
            });

        foreach ($cumpleaños as $cumple) {
            $alertaExistente = Alerta::where('dni', $cumple->dni)
                ->where('tipo', 'Cumpleaños')
                ->where('estado', 'Pendiente')
                ->exists();

            if (!$alertaExistente) {
                Alerta::create([
                    'dni' => $cumple->dni,
                    'tipo' => 'Cumpleaños',
                    'prioridad' => 'Media',
                    'destinatario' => 'Bienestar',
                    'titulo' => 'Cumpleaños próximo: ' . $cumple->trabajador->nombre_completo,
                    'descripcion' => $cumple->trabajador->nombre_completo . ' cumple años el ' .
                        Carbon::parse($cumple->fecha_cumpleaños)->format('d/m/Y') .
                        '. Giftcard pendiente de entregar.',
                    'fecha_alerta' => now()->toDateString(),
                    'estado' => 'Pendiente',
                    'color_indicador' => 'Amarillo',
                    'medio_notificacion' => 'Email,Sistema',
                ]);
            }
        }
    }

    /**
     * Generar alertas automáticas para contratos próximos a vencer (30 días)
     */
    public static function generarAlertasVencimiento()
    {
        $contratos = Contrato::where('estado', 'Activo')
            ->whereBetween('fecha_fin', [now(), now()->addDays(30)])
            ->with('trabajador')
            ->get();

        foreach ($contratos as $contrato) {
            $alertaExistente = Alerta::where('contrato_id', $contrato->id)
                ->where('tipo', 'Vencimiento de contrato')
                ->where('estado', 'Pendiente')
                ->exists();

            if (!$alertaExistente) {
                $diasRestantes = now()->diffInDays($contrato->fecha_fin);

                Alerta::create([
                    'dni' => $contrato->dni,
                    'contrato_id' => $contrato->id,
                    'tipo' => 'Vencimiento de contrato',
                    'destinatario' => 'RRHH',
                    'titulo' => 'Contrato próximo a vencer: ' . ($contrato->trabajador->nombre_completo ?? 'N/A'),
                    'descripcion' => sprintf(
                        'El contrato %s vence el %s (en %d días). Debe renovar o finalizar.',
                        $contrato->numero_contrato,
                        $contrato->fecha_fin->format('d/m/Y'),
                        $diasRestantes
                    ),
                    'fecha_alerta' => now(),
                    'fecha_vencimiento_evento' => $contrato->fecha_fin,
                    'prioridad' => 'Alta',
                    'color_indicador' => 'Amarillo',
                    'estado' => 'Pendiente',
                    'medio_notificacion' => 'Email,Sistema',
                ]);
            }
        }
    }

    /**
     * Generar alertas para trabajadores próximos a cumplir 5 años (57-59 meses)
     */
    public static function generarAlertasEstabilidad()
    {
        $trabajadores = Trabajador::where('estado', 'Activo')->get();

        foreach ($trabajadores as $trabajador) {
            $ultimaAdenda = Adenda::where('dni', $trabajador->dni)
                ->orderBy('tiempo_acumulado_total_meses', 'desc')
                ->first();

            $mesesAcumulados = 0;
            $contratoId = null;

            if ($ultimaAdenda) {
                $mesesAcumulados = $ultimaAdenda->tiempo_acumulado_total_meses;
                $contratoId = $ultimaAdenda->contrato_id;
            } else {
                $contratoActivo = Contrato::where('dni', $trabajador->dni)
                    ->where('estado', 'Activo')
                    ->first();

                if ($contratoActivo) {
                    $mesesAcumulados = $contratoActivo->tiempo_acumulado_meses;
                    $contratoId = $contratoActivo->id;
                }
            }

            if ($mesesAcumulados < 57 || $mesesAcumulados >= 60) {
                continue;
            }

            $alertaExistente = Alerta::where('dni', $trabajador->dni)
                ->where('tipo', 'Estabilidad laboral (5 años)')
                ->where('estado', 'Pendiente')
                ->exists();

            if (!$alertaExistente) {
                $mesesRestantes = 60 - $mesesAcumulados;

                Alerta::create([
                    'dni' => $trabajador->dni,
                    'contrato_id' => $contratoId,
                    'tipo' => 'Estabilidad laboral (5 años)',
                    'destinatario' => 'Multiple',
                    'titulo' => '⚠️ CRÍTICO: ' . $trabajador->nombre_completo . ' cerca de 5 años',
                    'descripcion' => sprintf(
                        'El trabajador %s tiene actualmente %d meses acumulados. Le falta solo %d mes(es) para cumplir 5 años de estabilidad laboral.',
                        $trabajador->nombre_completo,
                        $mesesAcumulados,
                        $mesesRestantes
                    ),
                    'fecha_alerta' => now(),
                    'prioridad' => 'Crítica',
                    'color_indicador' => 'Rojo',
                    'estado' => 'Pendiente',
                    'medio_notificacion' => 'Email,Sistema',
                ]);
            }
        }
    }
}
