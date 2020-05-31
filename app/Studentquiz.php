<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentquiz extends Model
{
    protected $table = 'student_quizzes';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
