<?php

namespace App\Http\Controllers;

use App\UserCoursesLog;
use Illuminate\Http\Request;
use App\Users;
class UserCoursesLogController extends Controller
{
    /**
     * Display all existing UserCoursesLog.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserCoursesLog::all();
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
           $usercourseslog = UserCoursesLog::create($rqst);
           if($usercourseslog){
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
     * @param  \App\UserCoursesLog  $UserCoursesLog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $usercourseslog = UserCoursesLog::find($id);
        return $usercourseslog;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCoursesLog  $UserCoursesLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCoursesLog $usercourseslog, $id)
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

           $usercourseslog = UserCoursesLog::find($id);
           if($usercourseslog && $usercourseslog->update($rqst)){
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
     * @param  \App\UserCoursesLog  $UserCoursesLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCoursesLog $usercourseslog, $id,Request $request)
    {

        //aux variables
        $ans = false;
        $msg = 'No tiene permisos para realizar esta acción';
        
        //obtaining data
        $rqst = $request->all(); 
        $user_id = isset($rqst['user_id'])?$rqst['user_id']:'';
        
        //check if the current user exist and is an admin
        if($this->userIsProfessor($user_id)){

           $usercourseslog = UserCoursesLog::find($id);

           if($usercourseslog && $usercourseslog->delete()){
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
