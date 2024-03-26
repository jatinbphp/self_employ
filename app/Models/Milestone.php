<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Milestone extends Model
{
    use HasFactory;

    protected $appends = ['created'];
    protected $fillable = ["project_id", "accept_offer_id", "amount", "description", "status"];

    public function getProjectMilestones()
    {
        return $this->belongsTo(Post::class, 'project_id', 'id');
    }

    public function getCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M, Y');
    }
}
