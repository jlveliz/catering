<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('recipes')) {
            Schema::create('recipes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('setting_key_id')->comment('Sirve para saber si es almuerzo, desayuno, merienda etc');
                $table->string('title')->unique();
                $table->integer('inventory_order_id')->nullable();
                $table->text('ingredients');
                $table->text('steps');
                $table->boolean('is_favorite');
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
        Schema::dropIfExists('recipes');
    }
}
