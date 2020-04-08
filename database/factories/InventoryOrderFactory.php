<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Catering\Models\InventoryOrder;
use Catering\Models\InventoryOrderType;
use Catering\Models\User;
use Faker\Generator as Faker;

$factory->define(InventoryOrder::class, function (Faker $faker) {
    return [
        'code' => $faker->randomLetter,
        'order_type_id' => InventoryOrderType::all()->random(1)->first()->id,
        'created_user_id' => User::all()->random(1)->first()->id
    ];
});
