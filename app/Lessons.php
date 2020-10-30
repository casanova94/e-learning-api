<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
    protected $fillable = [
       'name',
       'id_course',
       'previous_lesson',
       'approval_score',
       'description'
    ];
}
