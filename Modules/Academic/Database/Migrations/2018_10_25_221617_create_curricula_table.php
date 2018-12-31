<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic-curricula', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('courses');
            $table->longText('electives');
            $table->integer('version')->unique();
            $table->timestamps();
        }); 
        //elective = options, crhr, courses, code, type
        //courses = year, semester, institution
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic-curricula');
    }
}
