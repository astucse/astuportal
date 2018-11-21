<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting-management-meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('group_id')->unsigned();
            $table->timestamp('planned_time');
            $table->boolean('active')->default(true);
            $table->longText('decision')->nullable();
            $table->integer('raised_by_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('group_id')
                  ->references('id')->on('meeting-management-groups');
            $table->foreign('raised_by_id')
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
        Schema::dropIfExists('meeting-management-meetings');
    }
}
