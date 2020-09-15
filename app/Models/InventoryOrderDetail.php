<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryOrderDetail extends Model
{
    protected $fillable = [
        'inventory_order_id',
        'product_id',
        'count',
        'setting_key_id'
    ];


    /**
     * Relations
     */
    public function order()
    {
        return $this->belongsTo('Catering\Models\InventoryOrder', 'inventory_order_id');
    }
}
