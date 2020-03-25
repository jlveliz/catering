<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Catering\Models\Employee;
use Catering\Models\User;
use Catering\Models\Workplace;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {

    $civilStatus = [
        'casado',
        'soltero',
        'viudo',
        'divorciado',
        'union-libre'
    ];

    $genre = [
        'masculino',
        'femenino'
    ];

    return [
        'dni' => $faker->phoneNumber,
        'name' => $faker->name,
        'lastname' => $faker->lastName,
        'date_birth' => $faker->date,
        'address' => $faker->address,
        'civil_status' => $civilStatus[array_rand($civilStatus)],
        'genre' => $genre[array_rand($genre)],
        'phone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'emergency_contact_name' => $faker->name,
        'emergency_contact_phone' => $faker->phoneNumber,
        'salary' => $faker->randomFloat(),
        'position' => $faker->text(45),
        'date_admission' => $faker->date,
        'date_departure' => $faker->date,
        'state' => $faker->boolean,
        'workplace_id' => Workplace::all()->random(1)->first()->id,
        'user_created_at' => User::all()->random(1)->first()->id,
        'created_at' => now(),
        'updated_at' => now()
    ];
});
