<?php

namespace App\Console\Commands;

use App\Services\AlertaService;
use Illuminate\Console\Command;

class GenerarAlertasEstabilidad extends Command
{
    protected $signature = 'alertas:estabilidad';
    protected $description = 'Genera alertas para trabajadores próximos a cumplir 5 años (57-59 meses)';

    public function handle()
    {
        $this->info('🔍 Buscando trabajadores próximos a 5 años...');
        AlertaService::generarAlertasEstabilidad();
        $this->info('✅ Alertas de estabilidad laboral procesadas.');
        return 0;
    }
}