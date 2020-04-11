<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Catering\Models\Recipe;
use Catering\Models\Setting;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {

    $foodTypes = Setting::where('value','yes')->whereIn('key',[
        'breakfast',
        'lunch',
        'dinner',
        'dietary_breakfast',
        'dietary_lunch',
        'dietary_dinner'
    ])->get()->toArray();



    return [
        'setting_key_id' => $foodTypes[array_rand($foodTypes)]['id'],
        'title' => $faker->title,
        'steps'=> $faker->text,
        'ingredients' => $faker->text,
        'date_cook' => date('Y-m-d')
    ];
});
