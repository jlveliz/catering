<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Catering\Models\ProductType;
use Faker\Generator as Faker;

$factory->define(ProductType::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'slug' => $faker->unique()->slug
    ];
});
