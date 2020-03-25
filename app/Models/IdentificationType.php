<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class IdentificationType extends Model
{
    protected $fillable = [
        'name',
        'lock'
    ];
}
