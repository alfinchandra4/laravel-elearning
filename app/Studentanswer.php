<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentanswer extends Model
{
    protected $table = 'student_answers';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
