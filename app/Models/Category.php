<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $appends = ['created'];

    protected $fillable = ['name', 'parent_id', 'status'];

    public function getSkills(){
        return $this->hasMany(CategorySkill::class,'category_id','id');
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

    public function parentCategory(){
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function subCategory(){
        return $this->hasMany(Category::class, 'parent_id','id')->where('status','active');
    }

    public function allSubCategory(){
        return $this->hasMany(Category::class, 'parent_id','id');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($request) {
            $request->allSubCategory->each(function($allSubCategory) {
                $allSubCategory->delete();
            });
            $request->getSkills->each(function($getSkills) {
                $getSkills->delete();
            });
        });
    }
}
