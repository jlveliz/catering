<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Catering\Models\IdentificationType;
use Faker\Generator as Faker;

$factory->define(IdentificationType::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'lock' => $faker->boolean,
        'created_at' => now(),
        'updated_at' => now()
    ];
});
