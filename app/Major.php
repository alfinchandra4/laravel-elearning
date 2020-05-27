<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    public function student_major()
    {
        return $this->hasMany(Student::class, 'major_id', 'id');
    }
}
