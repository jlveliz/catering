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

    public function children()
    {
        return $this->hasMany('Catering\Models\Menu','parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('Catering\Models\Menu','parent_id');
    }
}
