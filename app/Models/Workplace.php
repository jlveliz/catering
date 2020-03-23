<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Workplace extends Model
{
    protected $fillable = [
        'name',
        'code',
        'address'
    ];
}
