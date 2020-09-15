<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'customer_id',
        'code',
        'detail',
        'state',
        'pay_before_at',
        'pay_method_id',
        'subtotal',
        'total_tax',
        'discount_percentege',
        'discount_total',
        'tip_total',
        'total_pay',
        'user_created_at'
    ];

    /**
     * Relations
     */

    public function customer()
    {
        return $this->belongsTo('Catering\Models\Customer', 'customer_id');
    }

    public function payMethod()
    {
        return $this->belongsTo('Catering\Models\PaymentMethod', 'pay_method_id');
    }

    public function details()
    {
        return $this->hasMany('Catering\Models\InvoiceDetail', 'invoice_id');
    }

    /**
     * Functions
     */


}
