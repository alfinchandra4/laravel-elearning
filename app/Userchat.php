<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userchat extends Model
{
    protected $table = 'user_chats';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
