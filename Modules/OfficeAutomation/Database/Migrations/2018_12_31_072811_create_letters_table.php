<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     *  letter: owner:office, body, title, tag, sendto, cc, status:[sent,draft]
     * @return void
     */
    public function up()
    {
        Schema::create('officeautomation-letters', function (Blueprint $table) {
            $table->increments('id');
            // $table->string('title');
            $table->longText('body');
            $table->longText('tags')->nullable();
            $table->string('category');
            $table->integer('owner_id')->unsigned();
            $table->longText('to');
            $table->longText('cc')->nullable();
            $table->enum('status',['sent','draft'])->default('draft');
            $table->timestamps();


            $table->foreign('owner_id')
                  ->references('id')->on('org-offices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('officeautomation-letters');
    }
}
