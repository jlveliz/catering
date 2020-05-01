<?php

namespace Catering\Models;

use Catering\Notifications\InvoicePaid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{

    use Notifiable;

    protected $fillable = [
        'identification_type',
        'identification',
        'is_company',
        'name',
        'lastname',
        'phone',
        'mobile',
        'email',
        'address',
        'legal_representant',
        'payment_method_id',
        'cut_invoice',
        'user_created_at'
    ];
    /**
     * RELATIONS
     */
    public function creator()
    {
        return $this->belongsTo('Catering\Models\User', 'user_created_at');
    }

    public function idType()
    {
        return $this->belongsTo('Catering\Models\IdentificationType', 'identification_type');
    }

    public function contracts()
    {
        return $this->hasMany('Catering\Models\CustomerContract','customer_id');
    }

    public function paymethod()
    {
        return $this->belongsTo('Catering\Models\PaymentMethod', 'payment_method_id');
    }

    /**
     * FUNCTIONS
     */
    public function getCurrentContract()
    {
        return $this->contracts()->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'))->first();
    }

    public function hasCurrentContract()
    {
        return $this->getCurrentContract() ?  true : false;
    }


    public function getOrdersToBill()
    {
        return (new Order())->getOrdersByCustomerCurrentContract($this->id);
    }

    public function sendInvoice(Invoice $invoice)
    {
        $this->notify( new InvoicePaid($invoice));
    }


}
