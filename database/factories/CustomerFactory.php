<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Catering\Models\Customer;
use Catering\Models\PaymentMethod;
use Catering\Models\User;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {


    $cuts = [
        'inicio_mes',
        'fin_mes',
        'cada_quincena'
    ];

    return [
        'identification_type' => 1,
        'identification' => $faker->phoneNumber,
        'is_company' => $faker->boolean,
        'name' => $faker->company,
        'lastname' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'mobile' => $faker->phoneNumber,
        'address' => $faker->address,
        'legal_representant' => $faker->name .' '. $faker->lastName,
        'payment_method_id' => PaymentMethod::all()->random(1)->first()->id,
        'cut_invoice' => $cuts[array_rand($cuts)],
        'user_created_at' => User::all()->random(1)->first()->id,
        'created_at' => now(),
        'updated_at' => now()
    ];
});
