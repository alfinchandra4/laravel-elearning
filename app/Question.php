<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function choices() {
        return $this->hasMany(Choices::class, 'question_id', 'id');
    }
}
