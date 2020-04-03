<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerContractDetail extends Model
{
    protected $fillable = [
        'customer_contract_id',
        'setting_key_id',
        'price'
    ];


    /**
     * RELATIONS
     */

    public function orders()
    {
        return $this->hasMany('Catering\Models\Order', 'customer_contract_detail_id');
    }


    public function contract()
    {
        return $this->belongsTo('Catering\Models\CustomerContract', 'customer_contract_id');
    }

    /**
     * Functions
     */
    public function hasOrders()
    {
        return count($this->orders) > 0 ? true : false;
    }

    public function getLastOrder()
    {
        return $this->orders()->orderBy('date','desc')->first();
    }
}
