<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'route_name',
        'icon',
        'parent_id',
        'order',
        'enabled'
    ];
}
