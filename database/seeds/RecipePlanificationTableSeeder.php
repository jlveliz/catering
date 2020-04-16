<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Catering\Models\Recipe;
use Catering\Models\RecipePlanification;

class RecipePlanificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recipe = Recipe::all()->random(1)->first()->id;


        for ($i = 0; $i < 15; $i++) {

            $recipeId = Recipe::all()->random(1)->first()->id;
            $obDate = Carbon::now();
            $i == 0 ? $date =  $obDate->format('Y-m-d') : $date = $obDate->addDays($i)->format('Y-m-d');

            RecipePlanification::create([
                'recipe_id' => $recipeId,
                'inventory_order_id' => null,
                'date_cook' => $date
            ]);
        }
    }
}
