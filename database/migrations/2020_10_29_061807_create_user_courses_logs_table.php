<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCoursesLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         $date = date('Y-m-d H:i:s');

         Schema::create('user_courses_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user_course');
            $table->foreign('id_user_course')
                  ->references('id')
                  ->on('user_courses')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->unsignedBigInteger('id_lesson');
            $table->foreign('id_lesson')
                  ->references('id')
                  ->on('lessons')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');    
            $table->tinyInteger('completed');  
            $table->timestamps();
        });

        // Insert some lessons
        $data = array(
              array(
                'id_user_course' => 1,
                'id_lesson' => 1,
                'completed' => 0,
                'created_at' => $date,
                'updated_at' => $date 
              ),
              array(
                'id_user_course' => 1,
                'id_lesson' => 2,
                'completed' => 0,
                'created_at' => $date,
                'updated_at' => $date 
              )
            );

        DB::table('user_courses_logs')->insert($data);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_courses_logs');
    }
}
