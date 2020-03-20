<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'slug'];



    public function users()
    {
        return $this->hasMany('Catering\Models\User', 'role_id', 'id');
    }
}
