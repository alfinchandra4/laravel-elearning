<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{
    protected $table = 'chats';
    protected $primaryKey = 'id';
    protected $guarded = [];
}