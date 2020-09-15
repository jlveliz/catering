<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Catering\Models\Provider;
use Faker\Generator as Faker;

$factory->define(Provider::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->company,
        'dni' => '9999999999',
        'address' => $faker->address,
        'observation' => $faker->paragraph,
    ];
});
