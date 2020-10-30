<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAnswersLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $date = date('Y-m-d H:i:s');

        Schema::create('user_answers_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_course_log');
            $table->foreign('id_course_log')
                  ->references('id')
                  ->on('user_courses_logs')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->unsignedBigInteger('id_question');
            $table->foreign('id_question')
                  ->references('id')
                  ->on('questions')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->unsignedBigInteger('id_answer');
            $table->foreign('id_answer')
                  ->references('id')
                  ->on('answers')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->timestamps();
        });

        // Insert some lessons
        $data = array(
              array(
                'id_course_log' => 1,
                'id_question' => 1,
                'id_answer' => 3,
                'created_at' => $date,
                'updated_at' => $date 
              ),
              array(
                'id_course_log' => 1,
                'id_question' => 2,
                'id_answer' => 6,
                'created_at' => $date,
                'updated_at' => $date 
              ),
              array(
                'id_course_log' => 1,
                'id_question' => 1,
                'id_answer' => 8,
                'created_at' => $date,
                'updated_at' => $date 
              )
            );

        DB::table('user_answers_logs')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_answers_logs');
    }
}
