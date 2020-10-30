<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $date = date('Y-m-d H:i:s');

        Schema::create('user_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->unsignedBigInteger('id_course');
            $table->foreign('id_course')
                  ->references('id')
                  ->on('courses')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->tinyInteger('completed')->nullable();
            $table->timestamps();
        });

         // Insert some lessons
        $data = array(
              array(
                'id_user' => 2,
                'id_course' => 1,
                'completed' => 0,
                'created_at' => $date,
                'updated_at' => $date 
              ),
              array(
                'id_user' => 2,
                'id_course' => 3,
                'completed' => 0,
                'created_at' => $date,
                'updated_at' => $date 
              )
            );

        DB::table('user_courses')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_courses');
    }
}
