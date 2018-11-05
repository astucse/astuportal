<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->enum('day',['monday','tuesday','wednesday','thursday','friday','saturday','sunday']);
            $table->time('start');
            $table->time('end');
            $table->timestamps();

            $table->foreign('group_id')
                  ->references('id')->on('groups');
            $table->foreign('course_id')
                  ->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
