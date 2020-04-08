<?php

use Catering\Models\InventoryOrderDetail;
use Illuminate\Database\Seeder;

class InventoryOrderDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(InventoryOrderDetail::class, 5)->create();
    }
}
