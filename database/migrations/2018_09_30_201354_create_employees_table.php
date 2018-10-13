<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_number')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('initial_password');
            $table->boolean('disability')->nullable();
            $table->enum('sex',['M','F']);
            $table->rememberToken();
            $table->timestamps();

            $table->unsignedInteger('change_id')->nullable();

        });
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
