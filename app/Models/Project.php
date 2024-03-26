<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $appends = [];

    protected $table = "projects";

    protected $fillable = [ "user_id", "status", 'post_id'];

    public function getJobPost()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
    public function getProjectOwner()
    {
        return $this->belongsTo(Post::class, 'user_id', 'id');
    }
}
