<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerContract extends Model
{
    protected $fillable = [
        'contract_code',
        'customer_id',
        'frequency_key_id',
        'start_date',
        'end_date'
    ];
}
