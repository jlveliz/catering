<?php

namespace Catering\Console\Commands;

use Carbon\Carbon;
use Catering\Events\InvoiceGenerated;
use Catering\Models\Customer;
use Catering\Models\Invoice;
use Catering\Models\InvoiceDetail;
use Catering\Models\Sequential;
use Catering\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class ManageInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manage-invoices {opt}';

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
     * Types of invoices
     * Generated
     */

    private $types = [
        'inicio_mes',
        'fin_mes',
        'cada_quincena',
        'caducar'
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * De acuerdo al argumento ingresado si es valido
         * comenzara a buscar a aquellos clientes que
         *  - tengan un contrato actual
         *  - que tengan ordenes que procesar para facturar
         *
         */

        if (!in_array($this->argument('opt'), $this->types)) {
            $this->error("la opcion {$this->argument('opt')} no es valida", 1);
            return false;
        }


        $type = $this->argument('opt');

        if ($type == 'caducar') {
            $this->expireInvoices();
        } else {
            $this->createInvoices($type);
        }



    }

    private function expireInvoices()
    {
        $invoices = Invoice::whereRaw(
            "(
                state = 'generada-automatica'
                or state = 'generada-manualmente'
            )
                and pay_before_at  < DATE_FORMAT(now(),'%Y-%m-%d') "
        )->get();

        if($invoices->count()){

            foreach ($invoices as $key => $invoice) {
                $invoice->state = 'mora';
                $messInvoice = "La factura del cliente {$invoice->customer->name} con codigo {$invoice->code}";
                if($invoice->save()) {
                    foreach ($invoice->details as $key => $detail) {
                        $order = $detail->order()->first();
                        $order->state = 'mora';
                        $mess = "Orden {$order->id} con fecha {$order->date}";
                        if($order->update()) {
                            $mess.= " ha sido puesta en mora ";
                            $this->info($mess);
                            Log::info($mess);
                        } else {
                            $mess.= " no pudo ser actualizada";
                            $this->error($mess);
                            Log::error($mess);
                        }
                    }
                    $messInvoice.= ' Se ha puesto en mora ';
                    $this->info($messInvoice);
                    Log::info($messInvoice);
                } else {
                    $messInvoice .= ' No se ha puesto en mora por errores';
                    $this->error($messInvoice);
                    Log::error($messInvoice);
                }
            }


        } else {
            $this->info("No hay facturas por caducar");
            Log::info("No hay facturas por caducar");
        }
    }

    /**
     * Genera Facturas segun el tipo o la fecha de corte de los clientes
     */

    private function createInvoices($type)
    {
          /*
         Extraigo clientes donde la fecha de corte sea igual al argumento ingresado
         y que tengan un contrato actual
        */
        $customers = Customer::where('cut_invoice', $type)->whereHas('contracts', function (Builder $query) {
            $query->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'));
        })->get();


        if ($customers->count() == 0) {
            return $this->info('No existen clientes para facturar');
        }

        foreach ($customers as $key => $customer) {
            $orders = $customer->getOrdersToBill();
            if ($orders->count() > 0) {
                $invoice = $this->generateInvoice($customer, $orders);
                if ($invoice) event(new InvoiceGenerated($invoice));
            } else {
                $this->info("El cliente {$customer->name} no tiene ordenes que facturar");
            }
        }
    }


    private function generateInvoice($customer, $orders)
    {
        $invoice = new Invoice();
        $invoice->customer_id = $customer->id;
        $invoice->code = (new Sequential())->createCode('invoice');
        $invoice->detail = $this->createDescription();
        $invoice->state = 'generada-automatica';
        $invoice->pay_before_at = $this->calculateBeforeDateAt();
        $invoice->pay_method_id = $customer->payment_method_id;
        $invoice->subtotal = $this->calculateSubtotal($orders);
        $invoice->total_tax = $this->calculateTax($invoice->subtotal);
        $invoice->discount_percentege = 0;
        $invoice->discount_total = 0;
        $invoice->tip_total = 0;
        $invoice->total_pay = $this->calculateTotal($invoice->subtotal, $invoice->total_tax, $invoice->discount_total, $invoice->tip_total);
        $invoice->user_created_at = 1;
        if ($invoice->save()) {
            //Save Invoice Details
            foreach ($orders as $key => $order) {
                $detailInvoiceModel =  new InvoiceDetail(['order_id' => $order->id]);
                if($invoice->details()->save($detailInvoiceModel)){
                    $order->state = 'facturado';
                    $order->update();
                }
            }
            $this->info(" {$customer->name}  ha Facturado {$orders->count()} ordenes para el corte de {$invoice->detail}");
            Log::info("{$customer->name}  ha Facturado {$orders->count()} ordenes para el corte de {$invoice->detail}");
            return $invoice;
        }

    }


    /**
     * Crea una descripcion de factura automaticamente
     *
     * @param string $type
     * @return void
     */
    private function createDescription()
    {
        $type = $this->argument('opt');
        $month = date('n');

        //Para saber si tiene una facturacion el mismo mes
        // usado para los que facturan cada quince dias
        if ($type ==  'inicio_mes' || $type == 'fin_mes'){
            $description = __('invoice.description-month');
        } elseif($type ==  'cada_quincena' && date('j') > 15) {
            $description= __('invoice.description-fifteen-2');
        } else {
            $description= __('invoice.description-fifteen-1');
        }


        /**
         * TODO CADA QUINCE DIAS
         */
        switch ($type) {
            case 'inicio_mes':
                $month++;
                $description .=  __('invoice.months.' . $month) . ' de ' . date('Y');
                break;
            case 'fin_mes':
                $description .=  __('invoice.months.' . $month) . ' de ' . date('Y');
                break;
            default:
                $description .=  __('invoice.months.' . $month) . ' de ' . date('Y');
                break;
        }

        return $description;
    }

    /**
     * Calcula la fecha de pago maximo
     *
     * @return string date
     */
    private function calculateBeforeDateAt()
    {
        $numDays =  $this->findSetting('wait_for_pay_invoices');
        $numDays =  $numDays->value ?  $numDays->value : 5;
        (int) $numDays;
        $now = (Carbon::now())->addDays($numDays);
        return $now->format('Y-m-d');
    }

    /**
     * Calculate Subtotal
     */

    private function calculateSubtotal($orders)
    {
        $sum = 0;
        foreach ($orders as $key => $order) {
            $sum+= $this->calculateTotalItemOrder($order);
        }
        return $sum;
    }

    /**
     * Calcula los totales de los detalles de una factura
     *
     * @param [type] $order
     * @return void
     */
    private function calculateTotalItemOrder($order)
    {
        $price = $order->contractDetail->price;
        return $price * $order->count;
    }


    /**
     * Calculate tax
     *
     * @param [type] $subtotal
     * @return void
     */
    private function calculateTax($subtotal)
    {
        $setting = $this->findSetting('iva');
        $taxPer =  $setting->value ?  $setting->value : 12;
        return ($taxPer / 100) * $subtotal;
    }


    /**
     * Calcula el gran total de la factura
     *
     * @param [type] $subtotal
     * @param [type] $tax
     * @param [type] $discount
     * @param [type] $tip
     * @return void
     */
    private function calculateTotal($subtotal,$tax, $discount,$tip)
    {
        $sum = $subtotal + $tax;

        if ($discount > 0) {
            $sum -= $discount;
        }

        if ($tip > 0) {
            $sum += $tip;
        }

        return $sum;

    }





    private function findSetting($key)
    {
        return Setting::select('value')->where('key', $key)->first();
    }
}
