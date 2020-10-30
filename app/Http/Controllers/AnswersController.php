<?php

namespace App\Http\Controllers;

use App\Answers;
use Illuminate\Http\Request;
use App\Users;
use App\Questions;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Answers::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //aux variables
        $ans = false;
        $msg = 'No tiene permisos para realizar esta acción';
        
        //obtaining data
        $rqst = $request->all();
        $user_id = isset($rqst['user_id'])?$rqst['user_id']:'';

        //check if the current user exist and is an admin
        if($this->userIsProfessor($user_id)){
           
           //check the question details
           $question = Questions::find($rqst['id_question']);

           if($question){
                $allowed = false;
                $type = $question['type'];
                 /*
                  Validate question/answers details
               
                  Type of question based on the "type" attribute of the Questions table
                  1- Boolean (Two options only, true or false)
                  2- Multiple choice where only one answer is correct
                  3- Multiple choice where more than one answer is correct
                  4- Multiple choice where more than one answer is correct and all of them must be answered correctly
               
                */
                switch ($type) {
                    case '1':
                        $answers_temp = Answers::where('id_question','=',1)->get();
                        //check if there are less than two answers
                        if(count($answers_temp) != 0 && count($answers_temp)<2){
                            
                            // check if the value exists in database
                            $answers_temp = $answers_temp[0];
                            $allowed = true;
                            
                            //check if there is a correct answer saved
                            if($this->getNumOfCorrectSaved($rqst['id_question']) == 1 && $rqst['correct'] == 1){
                                $allowed = false;
                                $msg = 'Solo puede haber una respuesta correcta';
                            }elseif ($this->getNumOfCorrectSaved($rqst['id_question']) == 0 && $rqst['correct'] == 0) {
                                $allowed = false;
                                $msg = 'Debe haber al menos una respuesta correcta';
                            }

                        }else{

                            //check if there aren't answers for this question
                            if(count($answers_temp) ==  0){
                               $allowed = true;
                            }else $msg = 'Solo se permiten dos respuestas a esta pregunta';
                        }

                        //this answer must be boolean
                        if($rqst['value'] != 0 && $rqst['value'] != 1){
                           $msg = 'Solo se permiten valores 0 y 1';
                           $allowed = false;
                        }
                        break;
                    case '2':
                        //check if there is an correct answer saved
                         if($this->getNumOfCorrectSaved($rqst['id_question']) == 1 && $rqst['correct'] == 1){
                            $allowed = false;
                            $msg = 'Solo se permite una opción correcta';
                         }else $allowed = true;
                        break;
                    case '3':
                        //this answer accepts multiple correct values
                        $allowed = true;
                        break;
                    case '4':
                        //this answer accepts multiple correct values
                        $allowed = true;
                        break;
                    default:
                        $msg = 'Tipo de pregunta no definida';
                        break;
                }
               
               //check if exists an answer with same value saved
               $answer_temp = Answers::where('id_question','=',$rqst['id_question'])->where('value','=',$rqst['value'])->count();
               if($answer_temp != 0){
                  $allowed = false;
                  $msg = 'Ya existe una respuesta el valor proporcionado';
               }

               if($allowed){

                   //save data
                   $answer = Answers::create($rqst);
                   if($answer){
                    $msg = 'Acción realizada';
                    $ans = true;
                   }else{
                    $msg = 'Ha ocurrido un problema';
                   }

                   
               }


           }else{
               $msg = 'La pregunta indicada no existe';
           }

        }
        
        
        return array('status' => $ans,'msg' => $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answers  $answers
     * @return \Illuminate\Http\Response
     */
    public function show(Answers $answers,$id)
    {
         $answer = Answers::find($id);
        return $answer;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answers  $answers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answers $answers,$id)
    {
        //aux variables
        $ans = false;
        $msg = 'No tiene permisos para realizar esta acción';
        
        //obtaining data
        $rqst = $request->all(); 
        $rqst['updated_at'] = date('Y-m-d H:i:s');
        $user_id = isset($rqst['user_id'])?$rqst['user_id']:'';
        
        //check if the current user exist and is an admin
        if($this->userIsProfessor($user_id)){

           $answer = Answers::find($id);
           if($answer && $answer->update($rqst)){
              $ans = true;
              $msg = 'Acción realizada';
           }else{
              $msg = 'Ha ocurrido un problema';
           }

        }

        return array('status' => $ans,'msg' => $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answers  $answers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answers $answers,Request $request, $id)
    {
        //aux variables
        $ans = false;
        $msg = 'No tiene permisos para realizar esta acción';
        
        //obtaining data
        $rqst = $request->all(); 
        $user_id = isset($rqst['user_id'])?$rqst['user_id']:'';
        
        //check if the current user exist and is an admin
        if($this->userIsProfessor($user_id)){

           $answer = Answers::find($id);

           if($answer && $answer->delete()){
              $ans = true;
              $msg = 'Acción realizada';
           }else{
              $msg = 'Ha ocurrido un problema';
           }

        }

        return array('status' => $ans,'msg' => $msg);
    }


    //check if current user is professor
    public function userIsProfessor($user_id){
        $user_temp = Users::find($user_id);
        return !empty($user_id) && $user_temp && $user_temp['type'] == 1;
    }

    //get the number of correct answers actually saved
    public function getNumOfCorrectSaved($question_id){
         return Answers::where('id_question','=',$question_id)->sum('correct');
    }
}
