<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('options')->default(1);
            $table->integer('year');
            $table->integer('crhr')->nullable();
            $table->enum('semester',[1,2,3]);
            $table->integer('institution_id')->unsigned()->nullable();
            $table->string('institution_type')->nullable();
            $table->string('courses')->nullable();
            $table->integer('curriculum_id')->unsigned();
            $table->enum('type',['free','mandatory','general']);
            $table->timestamps();

            $table->foreign('curriculum_id')
                  ->references('id')->on('curricula');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('electives');
    }
}
