<?php

use Catering\Models\InventoryOrderType;
use Illuminate\Database\Seeder;

class InventoryOrderTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['in-products','out-products'];

        foreach ($types as $key => $type) {
            InventoryOrderType::create([
                'name' => $type
            ]);
        }
    }
}
