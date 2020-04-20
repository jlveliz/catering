<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Catering\Models\Customer;
use Catering\Models\Invoice;
use Catering\Models\PaymentMethod;
use Catering\Models\User;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {

    $states = ['generada-manualmente','generada-automatica','pagada','mora','anulada'];

    return [
        'customer_id' => Customer::all()->random(1)->first()->id,
        'detail' => 'Pago de Factura',
        'state' =>  $states[array_rand($states)],
        'pay_before_at' => $faker->date('Y-m-d'),
        'pay_method_id' => PaymentMethod::all()->random(1)->first()->id,
        'subtotal' => $faker->randomFLoat(2),
        'total_tax' => $faker->randomFLoat(2),
        'discount_percentege'=>12,
        'discount_total'=>$faker->randomFLoat(2),
        'tip_total' => $faker->randomFLoat(2),
        'total_pay' => $faker->randomFLoat(2),
        'user_created_at' => User::all()->random(1)->first()->id
    ];
});
