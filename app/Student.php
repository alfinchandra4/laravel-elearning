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

    public function faculty() {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function major() {
        return $this->belongsTo(Major::class, 'major_id');
    }
}
