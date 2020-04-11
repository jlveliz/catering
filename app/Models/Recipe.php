<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'setting_key_id',
        'title',
        'inventory_order_id',
        'ingredients',
        'steps',
        'date_cook'
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function orderOut()
    {
        return $this->belongsTo('Catering\Models\InventoryOrder', 'inventory_order_id');
    }
}
