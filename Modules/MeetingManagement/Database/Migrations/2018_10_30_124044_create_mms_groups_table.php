<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMmsGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *s
     * @return void
     */
    public function up()
    {
        Schema::create('meeting-management-groups', function (Blueprint $table) {
            $table->date_interval_create_from_date_string()ements('id');
            $table->string('name');
            $table->integer('creator_id')->unsigned();
            $table->integer('admin_id')->unsigned();
            $table->timestamps();

            $table->foreign('creator_id')
                  ->references('id')->on('astu-employees');
            $table->foreign('admin_id')
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
        Schema::dropIfExists('meeting-management-groups');
    }
}
