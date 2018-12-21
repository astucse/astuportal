<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting-management-participants', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('signed')->default(false);
            $table->integer('meeting_id')->unsigned()->nullable();
            $table->integer('member_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('meeting_id')
                  ->references('id')->on('meeting-management-meetings');
            $table->foreign('member_id')
                  ->references('id')->on('astu-employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting-management-participants');
    }
}
