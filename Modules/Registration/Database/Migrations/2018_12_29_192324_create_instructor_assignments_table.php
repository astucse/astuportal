<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration-instructor_assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('academic_year')->nullable();
            $table->integer('semester')->nullable();
            $table->integer('course_id')->unsigned();
            $table->integer('group_id')->unsigned()->nullable();
            $table->integer('instructor_id')->unsigned();

            $table->integer('batch_year')->unsigned();
            $table->integer('institution_id')->unsigned();
            $table->string('institution_type');


            $table->timestamps();

            $table->foreign('course_id')
                  ->references('id')->on('academic-courses');
            $table->foreign('group_id')
                  ->references('id')->on('registration-classroom_groups');
            $table->foreign('instructor_id')
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
        Schema::dropIfExists('registration-instructor_assignments');
    }
}
