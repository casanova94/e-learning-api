<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        $date = date('Y-m-d H:i:s');
        
        Schema::create('lessons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('id_course');
            $table->foreign('id_course')
                  ->references('id')
                  ->on('courses')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->integer('previous_lesson')->nullable();
            $table->integer('approval_score');
            $table->string('description');
            $table->timestamps();
        });

        // Insert some lessons
        $data = array(
            array(
            'name' => 'Fundamentos de Programación',
            'id_course' => 1,
            'previous_lesson' => null,
            'approval_score' => '10',
            'description' => 'En este curso aprenderás las bases solidas para ser un buen programador',
            'created_at' => $date,
            'updated_at' => $date
            ),
            array(
            'name' => 'Programación orientada a objetos',
            'id_course' => 1,
            'previous_lesson' => 1,
            'approval_score' => '10',
            'description' => 'En este curso aprenderás el paradigma de la POO',
            'created_at' => $date,
            'updated_at' => $date
            ),
            array(
            'name' => 'Algoritmos de ordenamiento',
            'id_course' => 1,
            'previous_lesson' => 2,
            'approval_score' => '10',
            'description' => 'En este los algoritmos de ordenamiento más usados',
            'created_at' => $date,
            'updated_at' => $date
            ),
            );

        DB::table('lessons')->insert($data);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
