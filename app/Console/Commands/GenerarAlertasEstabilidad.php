<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Adenda;
use App\Models\Contrato;
use App\Models\Alerta;
use App\Models\Trabajador;

class GenerarAlertasEstabilidad extends Command
{
    protected $signature = 'alertas:estabilidad';
    protected $description = 'Genera alertas para trabajadores próximos a cumplir 5 años (57-59 meses)';

    public function handle()
    {
        $this->info('🔍 Buscando trabajadores próximos a 5 años...');

        // Obtener todos los trabajadores activos
        $trabajadores = Trabajador::where('estado', 'Activo')->get();
        
        $alertasCreadas = 0;

        foreach ($trabajadores as $trabajador) {
            // Buscar la última adenda del trabajador (la más reciente por tiempo acumulado)
            $ultimaAdenda = Adenda::where('dni', $trabajador->dni)
                ->orderBy('tiempo_acumulado_total_meses', 'desc')
                ->first();
            
            $mesesAcumulados = 0;
            $contratoId = null;
            
            if ($ultimaAdenda) {
                // Si tiene adendas, usar el tiempo de la última
                $mesesAcumulados = $ultimaAdenda->tiempo_acumulado_total_meses;
                $contratoId = $ultimaAdenda->contrato_id;
            } else {
                // Si no tiene adendas, buscar contrato activo
                $contratoActivo = Contrato::where('dni', $trabajador->dni)
                    ->where('estado', 'Activo')
                    ->first();
                
                if ($contratoActivo) {
                    $mesesAcumulados = $contratoActivo->tiempo_acumulado_meses;
                    $contratoId = $contratoActivo->id;
                }
            }
            
            // Solo procesar si tiene entre 57-59 meses
            if ($mesesAcumulados < 57 || $mesesAcumulados >= 60) {
                continue;
            }
            
            // Verificar si ya existe una alerta pendiente para este trabajador
            $alertaExistente = Alerta::where('dni', $trabajador->dni)
                ->where('tipo', 'Estabilidad laboral (5 años)')
                ->where('estado', 'Pendiente')
                ->first();

            if ($alertaExistente) {
                continue; // Ya existe, no crear duplicado
            }

            $mesesRestantes = 60 - $mesesAcumulados;

            // Crear nueva alerta
            Alerta::create([
                'dni' => $trabajador->dni,
                'contrato_id' => $contratoId,
                'tipo' => 'Estabilidad laboral (5 años)',
                'destinatario' => 'Multiple',
                'titulo' => '⚠️ CRÍTICO: ' . $trabajador->nombre_completo . ' cerca de 5 años',
                'descripcion' => sprintf(
                    'El trabajador %s tiene actualmente %d meses acumulados. Le falta solo %d mes(es) para cumplir 5 años de estabilidad laboral. DEBE TOMAR DECISIÓN URGENTE: Renovar como indefinido, NO renovar (cesar), o prórroga.',
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

            $alertasCreadas++;
            $this->info("✅ Alerta creada para {$trabajador->nombre_completo}: {$mesesAcumulados} meses");
        }

        $this->info("✅ Total: Se crearon {$alertasCreadas} alertas de estabilidad laboral.");
        return 0;
    }
}