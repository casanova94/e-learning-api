<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    protected $fillable = [
        'id_question',
        'answer_text',
        'correct',
        'value'
    ];
}
