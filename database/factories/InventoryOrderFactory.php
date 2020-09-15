<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Catering\Models\InventoryOrder;
use Catering\Models\InventoryOrderType;
use Catering\Models\Sequential;
use Catering\Models\User;
use Faker\Generator as Faker;

$factory->define(InventoryOrder::class, function (Faker $faker) {

    $sequential = new Sequential();

    $inventoryType =  InventoryOrderType::all()->random(1)->first();

    $type = $inventoryType->name == 'in-products' ? 'inv-i' : 'inv-o';

    $code = $sequential->createCode($type);

    return [
        'code' => $code,
        'order_type_id' => $inventoryType->id,
        'created_user_id' => User::all()->random(1)->first()->id
    ];
});
