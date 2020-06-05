<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quizzes extends Model
{
    protected $table = 'quizzes';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function lecturer() {
        return $this->belongsTo(Lecturer::class, 'lecturer_id');
    }
}
