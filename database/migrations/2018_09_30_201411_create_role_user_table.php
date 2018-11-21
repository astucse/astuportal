<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('astu-role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            
            $table->integer('roletaker_id')->unsigned();
            $table->string('roletaker_type');
            $table->integer('rolegiver_id')->unsigned()->nullable();
            $table->string('rolegiver_type')->nullable();
            $table->timestamps();

            $table->foreign('role_id')
                  ->references('id')->on('astu-roles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('astu-role_user');
    }
}
