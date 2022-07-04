<?php

namespace App\Console;

use App\Models\Sale;
use App\Mail\SaleReport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $sales = Sale::where('created_at', '>=', date('Y-m-d').' 00:00:00')->get();

            $salesamount = 0;
            foreach($sales as $sale){
                $salesamount += $sale['value'];
            }

            $mailData = [
                'date' => date('Y-m-d'),
                'value' => 'R$ '.$salesamount
            ];

            Mail::to('example@example.com')->send(new SaleReport($mailData));
        })->dailyAt('23:59');
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
