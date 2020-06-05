<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Lecturer extends Authenticatable
{
    use Notifiable;

    protected $table = 'lecturers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nidn', 'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'lecturer_id', 'id');
    }

    public function student_enrolled()
    {
        return $this->hasMany(Studentsenrolled::class, 'lecturer_id', 'id');
    }

    public function assignment() {
        return $this->hasMany(Assignment::class, 'lecturer_id', 'id');
    }

    public function quiz() {
        return $this->hasMany(Quizzes::class, 'lecturer_id', 'id');
    }
}
