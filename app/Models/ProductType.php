<?php

namespace Catering\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function products()
    {
        return $this->hasMany('Catering\Models\Product', 'product_type_id');
    }
}
