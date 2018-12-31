<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ses-evaluation_sessions', function (Blueprint $table) {
            $table->increments('id');
            // $table->string('uuid');
            $table->integer('student_evaluation_id')->unsigned();
            $table->integer('collegue_evaluation_id')->unsigned();
            $table->integer('head_evaluation_id')->unsigned();
            $table->integer('staff_id')->unsigned();
            $table->integer('assignment_id')->unsigned();
            $table->boolean('active')->default(true);

            $table->integer('academic_year');
            $table->integer('semester');

            $table->integer('course_id')->unsigned();

            $table->integer('target_institution_id')->unsigned()->nullable();
            $table->string('target_institution_type')->nullable();
            $table->string('target_groups');
            $table->integer('target_year')->unsigned();

            $table->integer('target_head_id')->unsigned();
            $table->string('target_collegues');

            $table->timestamps();

            $table->foreign('student_evaluation_id')
                  ->references('id')->on('ses-evaluations');
            $table->foreign('collegue_evaluation_id')
                  ->references('id')->on('ses-evaluations');
            $table->foreign('head_evaluation_id')
                  ->references('id')->on('ses-evaluations');
            $table->foreign('course_id')
                  ->references('id')->on('academic-courses');
                  
            $table->foreign('staff_id')
                  ->references('id')->on('astu-employees');
            $table->foreign('target_head_id')
                  ->references('id')->on('astu-employees');
            $table->foreign('assignment_id')
                  ->references('id')->on('registration-instructor_assignments');
                  // 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff-evaluation-evaluation_sessions');
    }
}
