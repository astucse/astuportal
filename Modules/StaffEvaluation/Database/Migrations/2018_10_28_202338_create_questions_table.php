<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('question_english');
            $table->text('question_amharic')->nullable();
            $table->enum('type',['rate','write'])->default('rate');
            $table->integer('evaluation_id')->unsigned();
            $table->integer('question_category_id')->unsigned();
            $table->timestamps();

            $table->foreign('evaluation_id')
                  ->references('id')->on('evaluations');
            $table->foreign('question_category_id')
                  ->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
