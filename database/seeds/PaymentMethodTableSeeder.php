<?php

use Catering\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payMethods = [
            'efectivo',
            'transferencia',
            'tarjeta-credito-debito'
        ];

        foreach ($payMethods as $key => $payMethod) {
            PaymentMethod::create([
                'name' => $payMethod,
                'lock' => 1
            ]);
        }
    }
}
