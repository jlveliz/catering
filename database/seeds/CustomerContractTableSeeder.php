<?php

use Carbon\Carbon;
use Catering\Models\Customer;
use Catering\Models\CustomerContract;
use Catering\Models\Setting;
use Catering\Models\Sequential;
use Illuminate\Database\Seeder;

class CustomerContractTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = Customer::all();
        $keyDays = Setting::where('key','monday_to_friday')->orWhere('key','monday_to_sunday')->get()->toArray();
        $now = Carbon::now();
        foreach ($customers as $key => $customer) {

            $sequential = new Sequential();

            $data = [
                'contract_code' => $sequential->createCode('contract'),
                'customer_id' => $customer->id,
                'frequency_key_id' => $keyDays[array_rand($keyDays)]['id'],
                'start_date' => $now->startOfYear()->format('Y-m-d'),
                'end_date' => $now->endOfYear()->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now()
            ];

            $contract = new CustomerContract();
            $contract->fill($data);
            $contract->save();

        }
    }
}
