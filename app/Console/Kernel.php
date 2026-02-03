<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
  protected function schedule(Schedule $schedule)
{
    // Generar alertas de cumpleaños diariamente a las 7:00 AM
    $schedule->command('alertas:cumpleanos')->dailyAt('07:00');
    
    // Generar alertas de vencimiento diariamente a las 8:00 AM
    $schedule->command('alertas:vencimiento')->dailyAt('08:00');
    
    // Generar alertas de estabilidad diariamente a las 8:00 AM
    $schedule->command('alertas:estabilidad')->dailyAt('08:00');
}

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}