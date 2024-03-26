<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $appends = ['created', 'post_time', 'due_date'];
    //protected $appends = ['created', 'post_time', 'due_date', 'member', 'flexible', 'location'];

    protected $table = "portfolios";

    protected $fillable = ["name", "date", "user_id", "description", "status", 'created_at', 'project_id'];

    public function getPortfolioPoster()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getProjectId()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function getPortfolioImages()
    {
        return $this->hasMany(PortfolioImage::class, 'portfolio_id', 'id');
    }

    public function getCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('D, d M, Y');
    }

    public function getPostTimeAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getDueDateAttribute()
    {
        return Carbon::parse($this->beforedate)->format('D, d M, Y');
    }
}
