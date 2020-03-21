<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Catering\Models\Workplace;
use Faker\Generator as Faker;

$factory->define(Workplace::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'code' => $faker->unique()->cityPrefix,
        'address' => $faker->address,
        'created_at' => now(),
        'updated_at' => now()
    ];
});
