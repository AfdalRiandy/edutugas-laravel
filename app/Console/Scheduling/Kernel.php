<?php

namespace App\Console\Scheduling;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Jalankan command setiap 12 jam
        $schedule->command('tasks:send-due-reminders')->twiceDaily(8, 20);
    }
}