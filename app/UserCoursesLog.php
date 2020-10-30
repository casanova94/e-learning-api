<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCoursesLog extends Model
{
    protected $fillable = [
        'id_user_course',
        'id_lesson',
        'completed'
    ];
}
