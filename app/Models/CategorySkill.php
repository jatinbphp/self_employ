<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySkill extends Model
{
    use HasFactory;
    protected $table = "category_skills";
    protected $appends = ['created'];

    protected $fillable = [
        'name', 'category_id'
    ];

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * The get Created at human read able attribute
     *
     * @var array<string, string>
     */
    public function getCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M, Y');
    }

    public function allPost(){
        return $this->hasMany(PostSkill::class, 'skill_id')->has('activePost')->select('id','post_id','skill_id');
    }

    public function allUserSkill(){
        return $this->hasMany(UserSkill::class, 'skill_id')->select('id','user_id','skill_id');
    }
}
