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

    public function employees()
    {
        return $this->hasMany('Catering\Models\Employee', 'workplace_id');
    }
}
