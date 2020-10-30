<?php

namespace App\Http\Controllers;

use App\Courses;
use App\Lessons;
use App\Users;
use App\UserCourses;
use App\UserCoursesLog;
use App\UserAnswersLog;
use Illuminate\Http\Request;
use App\Questions;

class SaveAllAnswersController extends Controller
{

     public function store(Request $request)
    {   
        $ans = false;        
        $msg = "Acción no realizada";
        //obtaining data
        $rqst = $request->all();
        $user_id = isset($rqst['user_id'])?$rqst['user_id']:'';
        $user = Users::find($user_id);

        if($user){
        	if($user['type'] == 2){
        	  $lesson = $rqst['lesson'];
              $answers = $rqst['answers'];
              
              //to answer all questions user must be taking a course (parent of this lesson) and the course should be saved in the user courses table
              $lesson_aux = Lessons::find($lesson);
              if($lesson_aux){
                 
                 $temp_user_courses = UserCourses::where('id_course','=',$lesson_aux['id_course'])->get();
                 if(count($temp_user_courses) != 0){
                 	$temp_user_courses = $temp_user_courses[0];
                 	
                 	//to answer all questions the lesson must be registered in the lessons log (user_courses_logs)
                 	$temp_lesson_log = UserCoursesLog::where('id_user_course','=',$temp_user_courses['id'])->where('id_lesson','=',$lesson)->get();
                 	if(count($temp_lesson_log) != 0){

                        $temp_lesson_log = $temp_lesson_log[0];
                        $answers2 = $answers;
                        
                        
                        foreach ($answers as $key => $answer) {
                        	//save each answer

                        	foreach ($answer as $key2 => $value) {
                                /*check is answer can be saved according to the contidions
                                
                                 1- Boolean (One option only)
                                 2- Multiple choice where only one answer is correct (multiple)
                                 3- Multiple choice where more than one answer is correct (multiple)
                                 4- Multiple choice where more than one answer is correct and all of them must be answered correctly (multiple)

                                */
                                
                                foreach ($value as $key3 => $value2) {
                        		//value to save as answer
                                   $temp_question = Questions::find($key2);
                                   if($temp_question){
                                     //check if type of question is boolean, then permit only one answer
                                    if($temp_question['type']==1){
                                       if(count($value) == 1)$this->saveAnswer($temp_lesson_log['id'],$key2,$value2);
                                       else{
                                         $msg = 'Solo se permite una respuesta de tipo bool';
                                       }
                                    }else{
                        		       $this->saveAnswer($temp_lesson_log['id'],$key2,$value2);
                                    }
                                   }
                                }
                        	}

                        }
                        $msg = "Acción realizada";
                        $ans = true;
                 	}else{
                 		$msg = 'Para contestar esta lección debe registrar la lección en lessons log';
                 	}
                 }

              }else{
              	$msg = "La lección no existe";
              }

        	}else{
        		$msg = "El usuario no tiene rol de estudiante";
        	}
        }

        return array('status'=>$ans,'msg'=>$msg);
    }

    //function to save answer
    public function saveAnswer($log_id,$question_id,$answer_id){
        $answer_temp = new UserAnswersLog;
        $answer_temp->id_course_log = $log_id;
        $answer_temp->id_question = $question_id;
        $answer_temp->id_answer = $answer_id;
        $answer_temp->save();
    }


}
