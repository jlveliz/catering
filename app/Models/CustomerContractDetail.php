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
}
