<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = [
         'type',
         'firstname',
         'secondname',
         'email',
         'password'
    ];

    public function userCourses(){
    	 return $this->hasMany('App\UserCourses','id_user','id');
    }
}
