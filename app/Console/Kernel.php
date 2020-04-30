<?php

namespace Catering\Console;

use Catering\Models\Setting;
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
        Commands\CreateOrders::class,
        Commands\CreateAppResource::class,
        Commands\ManageInvoices::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //Envia a crear ordenes todos los dias a las 3 AM
        $schedule->command('create-orders:current')->dailyAt('03:00');

        //Para generar facturas de acuerdo a la configuracion

        //Inicio mes
        $bginMonth = Setting::where('key','invoice_generation_begin_month')->first() ?
                        Setting::where('key','invoice_generation_begin_month')->first()->value : 28;
        $schedule->command('manage-invoices inicio_mes')->monthlyOn($bginMonth,'04:00');

        //Fin de mes
        $endinMonth = Setting::where('key','invoice_generation_end_month')->first() ?
                        Setting::where('key','invoice_generation_end_month')->first()->value : 25;
        $schedule->command('manage-invoices fin_mes')->monthlyOn($endinMonth,'04:00');


        //Quince dias
        $fifteenDays = Setting::where('key','invoice_each_fifteen_days')->first() ?
                        Setting::where('key','invoice_each_fifteen_days')->first()->value : 25;
        $schedule->command('manage-invoices cada_quincena')->monthlyOn($fifteenDays,'04:00');
        //Los otro quince dias
        $endinMonth = Setting::where('key','invoice_generation_end_month')->first() ?
                        Setting::where('key','invoice_generation_end_month')->first()->value : 25;
        $schedule->command('manage-invoices cada_quincena')->monthlyOn($endinMonth,'04:00');


        //Caducador de Facturas
        $schedule->command('manage-invoices caducar')->dailyAt('04:30');

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
