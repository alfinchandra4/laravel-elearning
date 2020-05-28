<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lessons';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function lesson_files() {
        return $this->hasMany(Lessonfiles::class, 'lesson_id', 'id');
    }
}
