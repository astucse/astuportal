<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnsweredQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ses-answered_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('session_token');
            $table->integer('evaluation_session_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('rate_answer')->nullable();
            $table->text('write_answer')->nullable();
            $table->enum('target',['student','collegue','head'])->nullable();
            $table->timestamps();

            $table->foreign('evaluation_session_id')
                  ->references('id')->on('ses-evaluation_sessions');
            $table->foreign('question_id')
                  ->references('id')->on('ses-questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ses-answered_questions');
    }
}
