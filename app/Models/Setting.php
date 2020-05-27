<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'category',
        'value'
    ];
}
