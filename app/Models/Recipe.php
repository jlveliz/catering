<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'setting_key_id',
        'title',
        'ingredients',
        'steps',
        'is_favorite'
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function orderOut()
    {
        return $this->belongsTo('Catering\Models\InventoryOrder', 'inventory_order_id');
    }

    public function planifications()
    {
        return $this->hasMany('Catering\Models\RecipePlanification', 'recipe_id');
    }
}
