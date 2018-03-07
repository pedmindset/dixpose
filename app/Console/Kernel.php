<?php

namespace App\Console;

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
        // 'App\Console\Commands\AddCustomerCollections',
       'App\Console\Commands\AddMonthlyBills'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('collection:customers')
        //         // ->weekly()
        //         // ->sundays()
        //         // ->at('22:00') 
        //          ->everyMinute()
        //          ->sendOutputTo('App/collection.txt');

       $schedule->command('bills:customers')
                 // ->weekly()
                 // ->sundays()
                 // ->at('22:00')
                  ->everyMinute()
                  ->sendOutputTo('App/bills.txt');


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
