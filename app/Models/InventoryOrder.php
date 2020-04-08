<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryOrder extends Model
{
    protected $fillable = [
        'code',
        'order_type_id',
        'created_user_id',
    ];


    /**
     * Relations
     */
    public function user()
    {
        return $this->belongsTo('Catering\Models\User', 'created_user_id');
    }

    public function type()
    {
        return $this->belongsTo('Catering\Models\InventoryOrderType', 'order_type_id');
    }
}
