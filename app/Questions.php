<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = [
        'question_text',
        'id_lesson',
        'score',
        'type'
    ];

    public function answers(){
    	 return $this->hasMany('App\Answers','id_question','id');
    }
}
