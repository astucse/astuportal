<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org-offices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->longText('option')->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->timestamps();
        });
        Schema::table('org-offices', function (Blueprint $table){
            $table->foreign('parent_id')->references('id')->on('org-offices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('org-offices');
    }
}
