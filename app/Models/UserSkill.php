<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    use HasFactory;

    protected $table = 'user_skills';
    protected $fillable = [
        'user_id',
        'category_id',
        'skill_id',
    ];

    public function getSkills(){
        return $this->belongsTo(CategorySkill::class,'skill_id','id');
    }
}