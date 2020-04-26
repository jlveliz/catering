<?php

namespace Catering\Console\Commands;

use Illuminate\Console\Command;

class ManageInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manage-invoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new Invoices and update invoices states';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * Verifica fecha actual
         *
         * si la fecha actual esta entre el 1-3 de cada mes
         * buscara a los clientes que tienen corte en esas fechas y pueden facturar
         *
         * Si la fecha actual esta entre el 14-16 de cada mes buscara a los clientes
         * que tienen corte de fecha cada quincena - SIN DUDA LOS QUE QUINCENA SON ALGO ESPECIAL
         *
         * Si la fecha actual esta entre el 29 - 31 y en febrero de 26-28
         * buscara a los clientes
         */
    }
}
