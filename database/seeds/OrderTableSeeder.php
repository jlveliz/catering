<?php

use Catering\Models\CustomerContractDetail;
use Illuminate\Database\Seeder;
use Catering\Models\Order;
use Catering\Models\Recipe;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detailsContract = CustomerContractDetail::all();
        $states = ['pendiente','entregado','cancelado'];

        foreach ($detailsContract as $key => $detail) {
            $recipeId = Recipe::all()->random(1)->first()->id;

            $order = new Order();
            $order->recipe_id = $recipeId;
            $order->customer_contract_detail_id = $detail->id;
            $order->date = date('Y-m-d');
            $order->count = rand(1,1000);
            $order->state = $states[array_rand($states)];
            $order->save();
        }
    }
}
