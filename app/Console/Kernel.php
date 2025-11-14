<?php

namespace App\Console;

use App\Console\Commands\StoreReminderEmails;
use App\Console\Commands\SendReminderEmails;
use App\Console\Commands\SendCancellationEmails;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command(StoreReminderEmails::class)->dailyAt('09:00');
        $schedule->command(SendReminderEmails::class)->withoutOverlapping()->everyFiveMinutes();
        $schedule->command(SendCancellationEmails::class)->withoutOverlapping()->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
