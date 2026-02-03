<?php

namespace App\Console\Commands;

use App\Models\Contrato;
use App\Models\Adenda;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RecalcularAdendas extends Command
{
    protected $signature = 'adendas:recalcular';
    protected $description = 'Recalcular tiempo acumulado de todas las adendas con precisión (meses + días)';

    public function handle()
    {
        $this->info('🔄 Recalculando adendas...');

        $contratos = Contrato::with('adendas')->get();
        $totalActualizadas = 0;

        foreach ($contratos as $contrato) {
            if ($contrato->adendas->isEmpty()) {
                continue;
            }

            // 1. Calcular duración del contrato original (en meses con decimales)
            $fechaInicioContrato = Carbon::parse($contrato->fecha_inicio);
            $fechaFinContrato = Carbon::parse($contrato->fecha_fin);
            $diasContrato = $fechaInicioContrato->diffInDays($fechaFinContrato);
            $mesesContrato = $diasContrato / 30.44;

            // 2. Recalcular cada adenda
            $mesesAcumulados = $mesesContrato;

            foreach ($contrato->adendas->sortBy('numero_adenda') as $adenda) {
                if ($adenda->estado === 'Cancelada') {
                    continue;
                }

                // Calcular duración de ESTA adenda
                $inicioAdenda = Carbon::parse($adenda->fecha_inicio);
                $finAdenda = Carbon::parse($adenda->fecha_fin);
                $diasAdenda = $inicioAdenda->diffInDays($finAdenda);
                $mesesAdenda = $diasAdenda / 30.44;

                // Sumar a acumulado
                $mesesAcumulados += $mesesAdenda;

                // Redondear a 3 decimales
                $mesesAcumulados = round($mesesAcumulados, 3);

                // Actualizar adenda
                $adenda->update([
                    'tiempo_acumulado_total_meses' => $mesesAcumulados
                ]);

                $totalActualizadas++;

                // Mostrar progreso
                $this->line("✓ Contrato: {$contrato->numero_contrato} | Adenda #{$adenda->numero_adenda} | Total: {$mesesAcumulados} meses");
            }

            // Actualizar también el contrato
            $contrato->update([
                'tiempo_acumulado_meses' => $mesesAcumulados
            ]);
        }

        $this->info("✅ ¡Listo! Se actualizaron {$totalActualizadas} adendas");
    }
}