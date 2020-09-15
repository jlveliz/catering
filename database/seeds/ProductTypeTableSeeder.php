<?php

use Illuminate\Database\Seeder;
use Catering\Models\ProductType;

class ProductTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductType::class,5)->create();
    }
}
