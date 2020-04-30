<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $fillable = [
        'invoice_id',
        'order_id'
    ];



    /**
     * Relations
     *
     * @return void
     */
    public function invoice()
    {
        return $this->belongsTo('Catering\Models\Invoice', 'invoice_id');
    }

    public function order()
    {
        return $this->belongsTo('Catering\Models\Order', 'order_id');
    }
}
