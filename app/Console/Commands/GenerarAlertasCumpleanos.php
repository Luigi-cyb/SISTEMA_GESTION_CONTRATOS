<?php

namespace App\Console\Commands;

use App\Models\Alerta;
use App\Models\Cumpleaños;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerarAlertasCumpleanos extends Command
{
    protected $signature = 'alertas:cumpleanos';
    protected $description = 'Generar alertas automáticas para cumpleaños próximos sin giftcard entregada';

    public function handle()
    {
        $this->info('Generando alertas de cumpleaños...');

        $hoy = Carbon::now();
        $fechaLimite = $hoy->copy()->addDays(5);

        $cumpleaños = Cumpleaños::with('trabajador')
            ->whereHas('trabajador', function($q) {
                $q->where('estado', 'Activo');
            })
            ->where('giftcard_entregada', false)
            ->get()
            ->filter(function($cumple) use ($hoy, $fechaLimite) {
                if (!$cumple->fecha_cumpleaños) return false;
                
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

                $this->info('✓ Alerta creada para: ' . $cumple->trabajador->nombre_completo);
            }
        }

        $this->info('Alertas de cumpleaños generadas correctamente.');
    }
}