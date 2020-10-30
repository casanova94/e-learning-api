<?php

namespace App\Http\Controllers;

use App\UserCourses;
use App\Users;
use App\Courses;
use Illuminate\Http\Request;

class UserCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserCourses::all();
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
           
           //check if user and course exists
           $user_temp = Users::find($rqst['id_user']);
           $course_temp = Courses::find($rqst['id_course']);
           

           //save data
            if($user_temp && $course_temp){
              $usercourses = UserCourses::create($rqst);
              if($usercourses){
               $msg = 'Acción realizada';
               $ans = true;
              }else{
               $msg = 'Ha ocurrido un problema';
              }
            }else{
                $msg = 'Usuario o curso no existente';
            }
        }

        return array('status' => $ans,'msg' => $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserCourses  $UserCourses
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $usercourses = UserCourses::find($id);
        return $usercourses;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCourses  $UserCourses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCourses $UserCourses, $id)
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

           $usercourses = UserCourses::find($id);
           if($usercourses && $usercourses->update($rqst)){
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
     * @param  \App\UserCourses  $UserCourses
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCourses $UserCourses, $id,Request $request)
    {

        //aux variables
        $ans = false;
        $msg = 'No tiene permisos para realizar esta acción';
        
        //obtaining data
        $rqst = $request->all(); 
        $user_id = isset($rqst['user_id'])?$rqst['user_id']:'';
        
        //check if the current user exist and is an admin
        if($this->userIsProfessor($user_id)){

           $usercourses = UserCourses::find($id);

           if($usercourses && $usercourses->delete()){
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
