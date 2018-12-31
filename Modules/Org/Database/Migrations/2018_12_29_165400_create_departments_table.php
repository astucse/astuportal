<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org-departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('duration')->default(5);
            $table->string('code')->unique();
            $table->integer('school_id')->unsigned();
            $table->text('description')->nullable();
            $table->longText('option')->nullable();
            $table->foreign('school_id')
                  ->references('id')->on('org-schools');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('org-departments');
    }
}
