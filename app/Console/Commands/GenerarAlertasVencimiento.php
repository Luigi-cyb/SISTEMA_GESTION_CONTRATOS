<?php

namespace App\Console\Commands;

use App\Services\AlertaService;
use Illuminate\Console\Command;

class GenerarAlertasVencimiento extends Command
{
    protected $signature = 'alertas:vencimiento';
    protected $description = 'Genera alertas automáticas para contratos próximos a vencer (30 días)';

    public function handle()
    {
        $this->info('🔍 Buscando contratos próximos a vencer...');
        AlertaService::generarAlertasVencimiento();
        $this->info('✅ Alertas de vencimiento procesadas.');
        return 0;
    }
}
