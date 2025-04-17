<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Register the commands for the application.
     */
    protected function commands(): array
    {
        return [
            \App\Console\Commands\SendTaskDueReminders::class,
        ];
    }
}