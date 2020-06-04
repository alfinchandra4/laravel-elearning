<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignments';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function lecturer() {
        return $this->belongsTo(Lecturer::class, 'lecturer_id');
    }

    public function student_assignment() {
        return $this->hasMany(Studentassignment::class, 'assignment_id', 'id');
    }
}
