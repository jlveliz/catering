<?php

use Catering\Models\Customer;
use Catering\Models\Invoice;
use Catering\Models\InvoiceDetail;
use Catering\Models\Order;
use Illuminate\Database\Seeder;

class InvoiceDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $invoices = Invoice::all();
        foreach ($invoices as $key => $invoice) {
            $orders = [];
            $contracts = $invoice->customer->contracts ? $invoice->customer->contracts : [];
            foreach ($contracts as $key => $contract) {
                foreach ($contract->details as $key => $detail) {
                    foreach ($detail->orders()->where('state','entregado')->get() as $key => $order) {
                        $orders[] = $order->id;
                    }
                }
            }

            // Save a Detail
            foreach ($orders as $key => $order) {
                InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'order_id' => $order
                ]);
            }

        }
    }
}
