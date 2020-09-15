<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_type_id',
        'name',
        'count',
        'setting_key_id'
    ];

    protected $casts = [
        'count' => 'integer'
    ];
}
