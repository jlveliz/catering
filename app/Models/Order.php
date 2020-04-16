<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'recipe_id',
        'customer_contract_detail_id',
        'date',
        'count',
        'state'
    ];

    /**
     * RELATIONS
     */
    public function contractDetail()
    {
        return $this->belongsTo('Catering\Models\CustomerContractDetail', 'customer_contract_detail_id');
    }
}
