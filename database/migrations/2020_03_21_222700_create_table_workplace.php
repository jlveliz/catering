<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableWorkplace extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('workplaces')) {
            Schema::create('workplaces', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('code',30)->unique();
                $table->string('name',45)->unique();
                $table->string('address')->nullable();
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
        Schema::dropIfExists('workplaces');
    }
}
