<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $guard = 'student';

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function student_enrolled()
    {
        return $this->hasMany(Studentsenrolled::class, 'student_id', 'id');
    }

    public function student_assignment()
    {
        return $this->hasMany(Studentassignment::class, 'student_id', 'id');
    }

    public function student_quiz()
    {
        return $this->hasMany(Studentquiz::class, 'student_id', 'id');
    }

    public function chat_room()
    {
        return $this->hasMany(Chatsroom::class, 'student_id', 'id');
    }
}
