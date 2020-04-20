<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->integer('customer_id');
            $table->string('detail');
            $table->enum('state',['generada-manualmente','generada-automatica','pagada','mora','anulada']);
            $table->date('pay_before_at');
            $table->integer('pay_method_id');
            $table->double('subtotal');
            $table->double('total_tax');
            $table->string('discount_percentege')->default(0);
            $table->double('discount_total');
            $table->double('tip_total');
            $table->double('total_pay');
            $table->integer('user_created_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
