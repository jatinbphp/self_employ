<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Team extends Model
{
    use HasFactory;
    protected $appends = ["profile_image", "cover_image"];

    protected $table = "teams";

    protected $fillable = ["id", "brand", "name", 'owner_id', 'job_complete', 'rating', 'on_time', 'on_budget', 'repeat_hire', 'image', 'cover', 'created_at', 'deleted'];

    public function getOwner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function getCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M, Y');
    }

    public function getProfileImageAttribute()
    {
        return env('APP_URL') . 'uploads/user/user_profile/' . $this->image;
    }

    public function getCoverImageAttribute()
    {
        return env('APP_URL') . 'uploads/user/user_cover/' . $this->cover;
    }

}
