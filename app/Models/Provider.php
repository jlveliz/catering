<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{

    protected $fillable = [
        'name',
        'dni',
        'address',
        'observation'
    ];
}
