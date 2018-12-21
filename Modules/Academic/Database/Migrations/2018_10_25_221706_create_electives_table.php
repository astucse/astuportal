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
        Schema::create('academic-electives', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('options')->default(1);
            $table->integer('crhr')->nullable();
            $table->string('courses')->nullable();
            $table->string('code')->unique();
            $table->enum('type',['free','mandatory','general']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic-electives');
    }
}
