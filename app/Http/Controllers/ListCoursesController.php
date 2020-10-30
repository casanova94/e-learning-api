<?php

namespace App\Http\Controllers;

use App\Courses;
use App\Users;
use Illuminate\Http\Request;

class ListCoursesController extends Controller
{

    public function index(Request $request)
    {   
        $all_courses = Courses::all();
        $id_user = $request['user_id'];
        
        $user_temp = Users::find($id_user);
        if($user_temp){
           $accesibles = array();
           //obtain user courses
           $temp_user_courses = $user_temp->userCourses()->get();

           //mark accesibles courses to the current user
           foreach ($temp_user_courses as $user_course) {
              foreach ($all_courses as $key => $course) {
                  if($user_course['id_course'] == $course['id']){
                      $all_courses[$key]['accesible'] = true;
                  }
                  if(!isset($all_courses[$key]['accesible'])){
                     $all_courses[$key]['accesible'] = false;
                  }
              }
           }
           
        }

        return $all_courses;
    }


}
