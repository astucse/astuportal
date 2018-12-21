<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
        name 
        academic_year
        year
        institution
        semester
     * @return void
     */
    public function up(){

        Schema::create('academic-groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('name');
            $table->integer('batch_year');
            $table->integer('semester');
            $table->year('year');
            $table->boolean('freshman')->default(false);
            $table->boolean('school')->default(false);
            $table->integer('institution_id')->unsigned()->nullable();
            $table->string('institution_type')->nullable();

            $table->timestamps();
            
            $table->unsignedInteger('change_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic-groups');
    }
}
