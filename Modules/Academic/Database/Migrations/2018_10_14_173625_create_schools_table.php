<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic-schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('academic-schools');
    }
}
