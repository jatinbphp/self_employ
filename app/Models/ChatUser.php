<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatUser extends Model
{
    use HasFactory;
    protected $table = "chat_users";
    protected $fillable = ['session_id', 'to_user_id', 'from_user_id'];

    public function getToUser()
    {
        return $this->belongsTo(User::class, 'to_user_id', 'id');
    }
    public function getFromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }
}
