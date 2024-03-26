<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcceptOffer extends Model
{
    use HasFactory;
    protected $table = "accept_offers";
    protected $fillable = ["user_id", "post_id", "post_user_id", "status"];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getJobPost()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
