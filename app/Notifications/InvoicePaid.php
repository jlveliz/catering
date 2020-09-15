<?php

namespace Catering\Notifications;

use Catering\Models\Invoice;
use Catering\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
    use Queueable;

    /**
     * Invoice Generated
     *
     * @var Invoice $invoice;
     */
    private $invoice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $companyName = $this->getCompanyName();
        $payMethod = $this->formatMethod($notifiable->paymethod->name);
        return (new MailMessage)
                    ->subject("{$companyName} - Factura de {$this->invoice->detail}")
                    ->line("Estimado(a) {$notifiable->name}")
                    ->line("Gracias por ser parte de {$companyName}. Hemos adjuntado en formato pdf la factura de {$this->invoice->detail}")
                    ->line("Recordamos que el pago debe hacerlo en {$payMethod}")
                    ->line('Gracias por preferirnos');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }


    private function getCompanyName()
    {
        return Setting::where('key','business_name')->first() ?
                    Setting::where('key','business_name')->first()->value
               :
                    config('app.name');
    }

    private function formatMethod($payMethod)
    {
        if ($payMethod == 'tarjeta-credito-debito') {
            $payMethod =  explode(' ',str_replace('-',' ',$payMethod));
            return $payMethod[0].' de '.$payMethod[1].' o '.$payMethod[2];
        } else {
            return $payMethod;
        }

    }
}
