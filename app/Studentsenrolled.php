<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentsenrolled extends Model
{
    protected $table = 'students_enrolled';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function lesson() {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

}
