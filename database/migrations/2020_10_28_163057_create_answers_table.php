<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $date = date('Y-m-d H:i:s');

        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_question');
            $table->foreign('id_question')
                  ->references('id')
                  ->on('questions')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->string('answer_text');
            $table->tinyInteger('correct')->nullable();
            $table->tinyInteger('value');
            $table->timestamps();
        });

        // Insert some questions
        $data = array(
                array(
                  'id_question' => 1,
                  'answer_text' => 'Códigos en diferentes idiomas',
                  'correct' => 0,
                  'value' => 1,
                  'created_at' => $date,
                  'updated_at' => $date 
                ),
                array(
                  'id_question' => 1,
                  'answer_text' => 'Letras y números',
                  'correct' => 0,
                  'value' => 2,
                  'created_at' => $date,
                  'updated_at' => $date 
                ),
                array(
                  'id_question' => 1,
                  'answer_text' => 'Conjunto de operadores y variables que son interpretados por la CPU',
                  'correct' => 1,
                  'value' => 3,
                  'created_at' => $date,
                  'updated_at' => $date 
                ),
                array(
                  'id_question' => 2,
                  'answer_text' => 'Un circuito',
                  'correct' => 0,
                  'value' => 1,
                  'created_at' => $date,
                  'updated_at' => $date 
                ),
                array(
                  'id_question' => 2,
                  'answer_text' => 'Una operación aritmética',
                  'correct' => 0,
                  'value' => 2,
                  'created_at' => $date,
                  'updated_at' => $date 
                ),
                array(
                  'id_question' => 2,
                  'answer_text' => 'Una función lógica para valores booleanos',
                  'correct' => 1,
                  'value' => 3,
                  'created_at' => $date,
                  'updated_at' => $date 
                ),
                 array(
                  'id_question' => 3,
                  'answer_text' => 'Si',
                  'correct' => 0,
                  'value' => 1,
                  'created_at' => $date,
                  'updated_at' => $date 
                ),
                array(
                  'id_question' => 3,
                  'answer_text' => 'No',
                  'correct' => 1,
                  'value' => 0,
                  'created_at' => $date,
                  'updated_at' => $date 
                ),
                array(
                  'id_question' => 4,
                  'answer_text' => 'Códigos en orden ascendente',
                  'correct' => 0,
                  'value' => 1,
                  'created_at' => $date,
                  'updated_at' => $date 
                ),
                array(
                  'id_question' => 4,
                  'answer_text' => 'Letras y números',
                  'correct' => 0,
                  'value' => 2,
                  'created_at' => $date,
                  'updated_at' => $date 
                ),
                array(
                  'id_question' => 4,
                  'answer_text' => 'Abstracción de elementos de la vida real a nivel código',
                  'correct' => 1,
                  'value' => 3,
                  'created_at' => $date,
                  'updated_at' => $date 
                ),
                array(
                  'id_question' => 5,
                  'answer_text' => 'Una clase',
                  'correct' => 0,
                  'value' => 1,
                  'created_at' => $date,
                  'updated_at' => $date 
                ),
                array(
                  'id_question' => 5,
                  'answer_text' => 'La instancia de una clase que ocupa un espacio en memoria',
                  'correct' => 1,
                  'value' => 2,
                  'created_at' => $date,
                  'updated_at' => $date 
                ),
                array(
                  'id_question' => 5,
                  'answer_text' => 'Una función',
                  'correct' => 0,
                  'value' => 3,
                  'created_at' => $date,
                  'updated_at' => $date 
                ),
            );

        DB::table('answers')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
