<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function lesson_files()
    {
        return $this->hasMany(Lessonfiles::class, 'lesson_id', 'id');
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id');
    }

    public function student_enrolled()
    {
        return $this->hasMany(Studentsenrolled::class, 'student_id', 'id');
    }
}
