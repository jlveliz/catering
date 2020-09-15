<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class RecipePlanification extends Model
{
    protected $fillable = [
        'recipe_id',
        'inventory_order_id',
        'date_cook'
    ];


    public function recipe()
    {
        return $this->belongsTo('Catering\Models\Recipe', 'recipe_id');
    }
}
