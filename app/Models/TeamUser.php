<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class TeamUser extends Model
{
    use HasFactory;
    protected $appends = ['user','team'];

    protected $table = "team_users";

    protected $fillable = ["id", "user_id", "team_id", "role", 'view_order','created_at'];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getTeam()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

        public function getCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M, Y');
    }
    
}
