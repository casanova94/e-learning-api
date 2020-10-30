<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        $date = date('Y-m-d H:i:s');

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('type');
            $table->string('firstname');
            $table->string('secondname');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });


        // Insert some questions
        /*
             Type:
             1 ->  teachers
             2 ->  students
        */
        $data = array(
            array(
              'type' => 1,
              'firstname' => 'Luis',
              'secondname' => 'Casanova',
              'email' => 'luis.casanova.pech@gmail.com',
              'password' => 'km4km399nknkn2ijh3.',
              'created_at' => $date,
              'updated_at' => $date 
            ),
            array(
              'type' => 2,
              'firstname' => 'Juan',
              'secondname' => 'Pérez',
              'email' => 'juan.perez@gmail.com',
              'password' => 'kmtbm399nknnnnrjh3.',
              'created_at' => $date,
              'updated_at' => $date 
            )

            );

        DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
