<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseBreakdownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic-course_breakdowns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('year');
            $table->enum('semester',[1,2,3]);
            $table->integer('institution_id')->unsigned()->nullable();
            $table->string('institution_type')->nullable();
            $table->string('courses')->nullable();
            $table->string('electives')->nullable();
            $table->integer('curriculum_id')->unsigned();
            $table->timestamps();

            $table->foreign('curriculum_id')
                  ->references('id')->on('academic-curricula');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic-course_breakdowns');
    }
}
