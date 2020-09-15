<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Catering\Models\Product;
use Catering\Models\ProductType;
use Catering\Models\Setting;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    return [
        'product_type_id' => ProductType::all()->random(1)->first()->id,
        'name' => $faker->unique()->name,
        'count' => $faker->randomNumber(3),
        'setting_key_id' => Setting::where('key','l')->orWhere('key','kg')->orWhere('key','lb')->get()->random('1')->first()->id
    ];
});
