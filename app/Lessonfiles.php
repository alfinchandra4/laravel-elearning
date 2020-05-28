<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lessonfiles extends Model
{
    protected $table = 'lesson_files';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function lesson() {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}
