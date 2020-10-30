<?php

namespace App\Http\Controllers;

use App\Questions;
use Illuminate\Http\Request;
use App\Users;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Questions::all();
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
           
           //save data
           $question = Questions::create($rqst);
           if($question){
            $msg = 'Acción realizada';
            $ans = true;
           }else{
            $msg = 'Ha ocurrido un problema';
           }

        }

        return array('status' => $ans,'msg' => $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function show(Questions $questions, $id)
    {
        $question = Questions::find($id);
        return $question;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questions $questions, $id)
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

           $question = Questions::find($id);
           if($question && $question->update($rqst)){
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
     * @param  \App\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questions $questions, $id, Request $request)
    {
        //aux variables
        $ans = false;
        $msg = 'No tiene permisos para realizar esta acción';
        
        //obtaining data
        $rqst = $request->all(); 
        $user_id = isset($rqst['user_id'])?$rqst['user_id']:'';
        
        //check if the current user exist and is an admin
        if($this->userIsProfessor($user_id)){

           $question = Questions::find($id);

           if($question && $question->delete()){
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
}
