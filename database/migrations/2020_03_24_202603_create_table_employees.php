<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('employees')) {
            Schema::create('employees', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->bigIncrements('id');
                $table->string('dni')->unique();
                $table->string('name',55);
                $table->string('lastname',55);
                $table->date('date_birth');
                $table->string('genre',10);
                $table->string('address',300);
                $table->string('civil_status',10)->nullable();
                $table->string('phone');
                $table->string('mobile')->nullable();
                $table->string('email',50)->unique();
                $table->longText('photo')->nullable();
                $table->text('emergency_contact_name',45)->nullable();
                $table->text('emergency_contact_phone')->nullable();
                $table->double('salary');
                $table->string('position',45)->nullable();
                $table->date('date_admission')->nullable();
                $table->date('date_departure')->nullable();
                $table->boolean('state');
                $table->integer('workplace_id');
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
        Schema::dropIfExists('employees');
    }
}
