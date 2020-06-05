<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentanswer extends Model
{
    protected $table = 'student_choices';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
