<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = "notification";

    protected $appends = ['date_time_str', 'date_human_readable'];
    protected $fillable = ['from_user', 'post_id', 'content', 'read', 'image', 'type', 'to', 'from_team_id'];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user');
    }

    public function fromTeamId()
    {
        return $this->belongsTo(Team::class, 'from_team_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to');
    }

    public function getDateTimeStrAttribute()
    {
        return date("Y-m-dTH:i", strtotime($this->created_at->toDateTimeString()));
    }

    public function getDateHumanReadableAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
