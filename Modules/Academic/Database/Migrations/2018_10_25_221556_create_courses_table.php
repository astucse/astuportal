<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic-courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('crhr')->default(0);
            $table->integer('prequisite_id')->unsigned()->nullable();
            $table->integer('prequisite_id2')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('academic-courses', function (Blueprint $table){
            $table->foreign('prequisite_id')->references('id')->on('academic-courses');
            $table->foreign('prequisite_id2')->references('id')->on('academic-courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic-courses');
    }
}
