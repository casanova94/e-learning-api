<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnswersLog extends Model
{
    protected $fillable = [
        'id_course_log',
        'id_question',
        'id_answer'
    ];
}
