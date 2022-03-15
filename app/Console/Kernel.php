<?php

namespace App\Console;

use App\Console\Commands\SaveData;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SendEmail::class,
        Commands\SellAuto::class,
        Commands\SaveData::class,
        Commands\ExpireUser::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('send:email')->everyMinute();
        $schedule->command('sell:auto')->everyMinute()->runInBackground();
        $schedule->command('cron:savedata')->weekdays()->at('17:00');
        $schedule->command('expire:user')->weekdays()->at('23:59');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
