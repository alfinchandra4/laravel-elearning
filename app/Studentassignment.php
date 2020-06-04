<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentassignment extends Model
{
    protected $table = 'student_assignments';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
