<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInventoryOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('inventory_order_details')) {
            Schema::create('inventory_order_details', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('inventory_order_id');
                $table->integer('product_id');
                $table->integer('count');
                $table->integer('setting_key_id');
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
        Schema::dropIfExists('inventory_order_details');
    }
}
