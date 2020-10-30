<?php

namespace App\Http\Controllers;

use App\Lessons;
use App\Courses;
use App\Users;
use Illuminate\Http\Request;

class LessonsForCourseController extends Controller
{

    public function show(Request $request,$id)
    {   
    	$id_user = $request['user_id'];
    	$course = Courses::find($id);

    	if($course){
            //obtain all existing lessons
            $all_lessons = Lessons::where('id_course','=',$id)->get();
            if(count($all_lessons)){
            	$ans = $all_lessons;
            	$user_temp = Users::find($id_user);
                $current_lessons = array();
            	//get user courses
                $temp_user_courses = $user_temp->userCourses()->get();
                //get log of each course of the user
                foreach ($temp_user_courses as $user_course) {
                    $temp_log = $user_course->userCoursesLog()->get();
                    foreach ($temp_log as $log) {
                    	$current_lessons[] = $log['id_lesson'];
                    }
                }
                if(!empty($current_lessons)){
                	//mark lessons accesibles for user
                    foreach ($current_lessons as $current_lesson) {
                       foreach ($all_lessons as $key => $lesson) {
                       	 if($current_lesson == $lesson['id']){
                       	 	$all_lessons[$key]['accesible'] = true;
                       	 }
                       	 if(!isset($all_lessons[$key]['accesible'])){
                       	 	$all_lessons[$key]['accesible'] = false;
                       	 }
                       }
                    }
                }

            }else{
            	$ans = 'Este curso no tiene lecciones';
            }
    	}else{
    		$ans = 'El curso no existe';
    	}
        return $ans;
    }


}
