<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('users:state')->weekly();
        $schedule->command('suscription:state')->daily();
        // $schedule->command('update:days')->everyTwoMinutes();
        // $schedule->command('suscription:state')->everyTwoMinutes();
    }

    
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
