<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('astu-admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('email');
            $table->string('name')->nullable();
            $table->string('password');
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
        Schema::dropIfExists('astu-admins');
    }
}
