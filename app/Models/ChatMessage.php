<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    protected $table = "chat_messages";
    protected $appends = ["chat_image"];
    protected $fillable = ["chat_message_id", "to_user_id", "from_user_id", "chat_message", "images", "status"];
    /**
     * The get Profile Url attribute
     *
     * @var array<string, string>
     */
    public function getChatImageAttribute()
    {
        return env('APP_URL') . 'uploads/chat/' . $this->images;
    }
}
