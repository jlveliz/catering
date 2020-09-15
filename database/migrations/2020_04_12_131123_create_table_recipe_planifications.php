<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRecipePlanifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('recipe_planifications')) {
            Schema::create('recipe_planifications', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('recipe_id');
                $table->integer('inventory_order_id')->nullable();
                $table->date('date_cook');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_planifications');
    }
}
