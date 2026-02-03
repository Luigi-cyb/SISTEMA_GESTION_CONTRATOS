<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contrato;
use App\Models\Alerta;
use Carbon\Carbon;

class GenerarAlertasVencimiento extends Command
{
    protected $signature = 'alertas:vencimiento';
    protected $description = 'Genera alertas automáticas para contratos próximos a vencer (30 días)';

    public function handle()
    {
        $this->info('🔍 Buscando contratos próximos a vencer...');

        // Buscar contratos activos que vencen en los próximos 30 días
        $contratos = Contrato::where('estado', 'Activo')
            ->whereBetween('fecha_fin', [now(), now()->addDays(30)])
            ->with('trabajador')
            ->get();

        $alertasCreadas = 0;

        foreach ($contratos as $contrato) {
            // Verificar si ya existe una alerta para este contrato
            $alertaExistente = Alerta::where('contrato_id', $contrato->id)
                ->where('tipo', 'Vencimiento de contrato')
                ->where('estado', 'Pendiente')
                ->first();

            if ($alertaExistente) {
                continue; // Ya existe, no crear duplicado
            }

            $diasRestantes = now()->diffInDays($contrato->fecha_fin);

            // Crear nueva alerta
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

            $alertasCreadas++;
        }

        $this->info("✅ Se crearon {$alertasCreadas} alertas de vencimiento.");
        return 0;
    }
}
