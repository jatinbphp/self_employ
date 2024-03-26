<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;
    protected $appends = ['post_images'];
    protected $table = 'post_images';

    protected $fillable = [
        'image',
        'post_id'
    ];

    public function getPostImagesAttribute()
    {
        return env('APP_URL') . 'uploads/posts/post_images/' . $this->image;
    }
}
