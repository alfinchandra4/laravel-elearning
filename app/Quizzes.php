<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quizzes extends Model
{
    protected $table = 'quizzes';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
