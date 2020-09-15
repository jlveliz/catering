<?php

namespace Catering\Listeners;

use Catering\Events\InvoiceGenerated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendInvoiceEmailCustomer
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  InvoiceGenerated  $event
     * @return void
     */
    public function handle(InvoiceGenerated $event)
    {
        $customer = $event->invoice->customer;
        $invoice = $event->invoice;
        $customer->sendInvoice($invoice);
    }
}
