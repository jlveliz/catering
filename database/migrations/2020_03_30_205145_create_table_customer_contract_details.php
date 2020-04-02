<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCustomerContractDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('customer_contract_details')) {
            Schema::create('customer_contract_details', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('customer_contract_id');
                $table->enum('setting_key_id',[
                    'breakfast',
                    'lunch',
                    'dinner',
                    'dietary_breakfast',
                    'dietary_lunch',
                    'dietary_dinner'
                    ]
                )->comment('Saber si vendera desayunos almuerzos o meriendas');
                $table->double('price');
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
        Schema::dropIfExists('customer_contract_details');
    }
}
