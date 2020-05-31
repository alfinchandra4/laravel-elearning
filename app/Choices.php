<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choices extends Model
{
    protected $table = 'choices';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function questions() {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
