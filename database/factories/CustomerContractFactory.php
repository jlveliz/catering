<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Catering\Models\CustomerContract;
use Catering\Models\Customer;
use Catering\Models\Sequential;
use Catering\Models\Setting;
use Faker\Generator as Faker;

$factory->define(CustomerContract::class, function (Faker $faker) {

    $keyDays = Setting::where('key','monday_to_friday')->orWhere('key','monday_to_sunday')->get()->toArray();

    $sequential = new Sequential();

    return [
        'contract_code' => $sequential->createCode('contract'),
        'customer_id' => Customer::all()->random(1)->first()->id,
        'frequency_key_id' => $keyDays[array_rand($keyDays)]['id'],
        'start_date' => $faker->date('Y-m-d'),
        'end_date' => $faker->date('Y-m-d'),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
