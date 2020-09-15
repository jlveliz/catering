<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class IdentificationType extends Model
{
    protected $fillable = [
        'name',
        'lock'
    ];

    public function customers()
    {
        return $this->hasMany('Catering\Models\Customer', 'identification_type');
    }
}
