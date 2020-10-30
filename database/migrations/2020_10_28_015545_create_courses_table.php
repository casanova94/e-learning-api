<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        $date = date('Y-m-d H:i:s');

        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('previous_course')->nullable();
            $table->timestamps();
        });

        // Insert some courses
        $data = array(
            array(
            'name' => 'Programación',
            'created_at' => $date,
            'updated_at' => $date
            ),
            array(
            'name' => 'Matemáticas',
            'created_at' => $date,
            'updated_at' => $date
            ),
            array(
            'name' => 'Diseño',
            'created_at' => $date,
            'updated_at' => $date
            ));

        DB::table('courses')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
