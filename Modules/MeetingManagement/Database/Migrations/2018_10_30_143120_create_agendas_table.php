<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting-management-agendas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('meeting_id')->unsigned()->nullable();
            $table->longText('body')->nullable();
            $table->integer('raised_by_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('meeting_id')
                  ->references('id')->on('meeting-management-meetings');
            $table->foreign('raised_by_id')
                  ->references('id')->on('astu-employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting-management-agendas');
    }
}
