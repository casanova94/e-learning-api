<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCourses extends Model
{
     protected $fillable = [
       
       'id_user',
       'id_course',
       'completed'      
    ];

     public function userCoursesLog(){
    	 return $this->hasMany('App\UserCoursesLog','id_user_course','id');
    }
}
