<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{

    /**
     * 
     *  
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('org-schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code')->unique();   
            $table->longText('option')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('org-schools');
    }
}
