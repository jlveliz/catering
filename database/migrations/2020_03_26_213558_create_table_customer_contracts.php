<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCustomerContracts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('customer_contracts')) {
            Schema::create('customer_contracts', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('contract_code',30)->unique();
                $table->integer('customer_id');
                $table->integer('frequency_key_id')->comment('extrae desde key la configuracion que permite si las entregas va a ser de lun-vi o lun-dom');
                $table->date('start_date');
                $table->date('end_date');
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
        Schema::dropIfExists('customer_contracts');
    }
}
