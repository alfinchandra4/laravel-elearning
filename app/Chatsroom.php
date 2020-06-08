<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatsroom extends Model
{
    protected $table = 'chats_room';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id');
    }

    // public function student_chat() {
    //     return $this->hasMany(Studentchats::class, 'chatroom_id', 'id');
    // }

    // public function lecturer_chat() {
    //     return $this->hasMany(Lecturerchats::class, 'chatroom_id', 'id');
    // }
}
