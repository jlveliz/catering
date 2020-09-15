<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Catering\Models\InventoryOrder;
use Catering\Models\InventoryOrderDetail;
use Catering\Models\Product;
use Catering\Models\Setting;
use Faker\Generator as Faker;

$factory->define(InventoryOrderDetail::class, function (Faker $faker) {
    return [
        'inventory_order_id' => InventoryOrder::all()->random(1)->first()->id,
        'product_id' => Product::all()->random(1)->first()->id,
        'count' => 10 ,
        'setting_key_id' => Setting::where('key','l')->orWhere('key','kg')->orWhere('key','lb')->get()->random('1')->first()->id
    ];
});
