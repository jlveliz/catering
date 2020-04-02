<?php

use Catering\Models\CustomerContract;
use Catering\Models\CustomerContractDetail;
use Catering\Models\Setting;
use Illuminate\Database\Seeder;

class CustomerContractDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $customersContract = CustomerContract::all();
        $settingsFood =Setting::where('value','yes')->whereIn('key',[
            'breakfast',
            'lunch',
            'dinner',
            'dietary_breakfast',
            'dietary_lunch',
            'dietary_dinner'
        ])->get();



        //Se ingresa cada contrato
        foreach ($customersContract as  $contract) {
            //Por cada contrato se ingresa una comida
            foreach ($settingsFood as $key => $food) {
                $randPrice = rand(2,5);
                CustomerContractDetail::create([
                    'customer_contract_id' => $contract->id,
                    'setting_key_id' => $food->key,
                    'price' => number_format( (float) $randPrice, 2,'.',''),
                ]);
            }


        }

    }
}
