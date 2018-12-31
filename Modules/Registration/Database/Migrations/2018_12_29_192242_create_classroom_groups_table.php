<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration-classroom_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('name');
            $table->integer('batch_year');
            $table->integer('semester');
            $table->year('year');
            $table->boolean('preengineering')->default(false);
            $table->boolean('prescience')->default(false);
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
        Schema::dropIfExists('registration-classroom_groups');
    }
}
