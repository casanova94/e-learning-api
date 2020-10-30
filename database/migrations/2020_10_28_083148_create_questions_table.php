<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        $date = date('Y-m-d H:i:s');

        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question_text');
            $table->unsignedBigInteger('id_lesson');
            $table->foreign('id_lesson')
                  ->references('id')
                  ->on('lessons')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->integer('score');
            $table->tinyInteger('type');
            $table->timestamps();
        });

        // Insert some questions
        $data = array(
            array(
              'question_text' => '¿Que es un lenguaje de programación?',
              'id_lesson' => 1,
              'score' => 3,
              'type' => 2,
              'created_at' => $date,
              'updated_at' => $date 
            ),
            array(
              'question_text' => '¿Que es un operador lógico?',
              'id_lesson' => 1,
              'score' => 3,
              'type' => 2,
              'created_at' => $date,
              'updated_at' => $date 
            ),
            array(
              'question_text' => '¿PHP es un lenguaje de bajo nivel?',
              'id_lesson' => 1,
              'score' => 3,
              'type' => 1,
              'created_at' => $date,
              'updated_at' => $date 
            ),
            array(
              'question_text' => '¿Que es una clase?',
              'id_lesson' => 2,
              'score' => 3,
              'type' => 2,
              'created_at' => $date,
              'updated_at' => $date 
            ),
            array(
              'question_text' => '¿Que es un objeto?',
              'id_lesson' => 2,
              'score' => 3,
              'type' => 2,
              'created_at' => $date,
              'updated_at' => $date 
            )

            );

        DB::table('questions')->insert($data);
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
