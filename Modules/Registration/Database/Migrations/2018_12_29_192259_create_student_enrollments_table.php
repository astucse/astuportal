<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration-student_enrollments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('group_id')->unsigned()->nullable();
            $table->boolean('assigned')->default(true);

            $table->timestamps();
            $table->foreign('student_id')
                  ->references('id')->on('astu-students');
            $table->foreign('group_id')
                  ->references('id')->on('registration-classroom_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registration-student_enrollments');
    }
}
