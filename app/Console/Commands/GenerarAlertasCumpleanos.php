<?php

namespace App\Console\Commands;

use App\Services\AlertaService;
use Illuminate\Console\Command;

class GenerarAlertasCumpleanos extends Command
{
    protected $signature = 'alertas:cumpleanos';
    protected $description = 'Generar alertas automáticas para cumpleaños próximos sin giftcard entregada';

    public function handle()
    {
        $this->info('Generando alertas de cumpleaños...');
        AlertaService::generarAlertasCumpleaños();
        $this->info('Alertas de cumpleaños generadas correctamente.');
    }
}