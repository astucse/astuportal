<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('astu-options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->longText('value');
            $table->longText('list')->nullable();
            $table->string('description')->nullable();
            $table->string('parameter_1')->nullable();
            $table->string('parameter_2')->nullable();
            $table->string('parameter_3')->nullable();
            $table->string('parameter_4')->nullable();
            $table->string('parameter_5')->nullable();
            $table->string('parameter_6')->nullable();
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
        Schema::dropIfExists('astu-options');
    }
}
