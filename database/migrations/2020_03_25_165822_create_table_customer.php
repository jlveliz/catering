<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('customers')) {
            Schema::create('customers', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->bigIncrements('id');
                $table->integer('identification_type')->unsigned();
                $table->string('identification')->unique();
                $table->boolean('is_company');
                $table->string('name');
                $table->string('lastname')->nullable();
                $table->string('phone');
                $table->string('mobile')->nullable();
                $table->string('email',50)->unique();
                $table->string('address',300);
                $table->string('legal_representant',50);
                $table->integer('payment_method_id');
                $table->enum('cut_invoice',['inicio_mes','fin_mes','cada_quincena']);
                $table->integer('user_created_at');
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
        Schema::dropIfExists('customers');
    }
}
