<?php

use Catering\Models\InventoryOrder;
use Illuminate\Database\Seeder;

class InventoryOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(InventoryOrder::class,5)->create();
    }
}
