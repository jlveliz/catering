<?php

use Catering\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Recipe::class,5)->create();
    }
}
