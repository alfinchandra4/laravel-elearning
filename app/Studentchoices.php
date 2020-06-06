<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentchoices extends Model
{
    protected $table = 'student_choices';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
