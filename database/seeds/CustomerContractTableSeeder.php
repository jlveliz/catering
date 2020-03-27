<?php

use Catering\Models\CustomerContract;
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
        factory(CustomerContract::class,5)->create();
    }
}
