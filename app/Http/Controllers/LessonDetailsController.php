<?php

namespace App\Http\Controllers;

use App\Questions;
use Illuminate\Http\Request;

class LessonDetailsController extends Controller
{

   public function show($lesson_id){
     $details = array();

     //obtain all lesson questions
     $questions = Questions::where('id_lesson','=',$lesson_id)->get();
     if(count($questions) != 0){
        foreach ($questions as $question) {
            $temp_row = array('id_question' => $question['id'],'question' => $question['question_text'],'score' => $question['score'],'type' => $question['type'],'answers' => $question['answers']);
            $details[] = $temp_row;
        }
     }else{
        $details = 'No se encontraron preguntas para esta lección';
     }
     return $details;
   }

}
