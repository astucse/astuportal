<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic-enrollments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('group_id')->unsigned()->nullable();
            $table->boolean('assigned')->default(true);

            $table->timestamps();
            $table->foreign('student_id')
                  ->references('id')->on('astu-students');
            $table->foreign('group_id')
                  ->references('id')->on('academic-groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic-enrollments');
    }
}
