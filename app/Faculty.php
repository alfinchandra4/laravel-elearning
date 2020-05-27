<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public function student_faculty() {
        return $this->hasMany(Student::class, 'faculty_id', 'id');
    }
}
