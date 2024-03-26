<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = "settings";
    
    protected $fillable = [
        'meta_title',
        'child_meta_title',
        'title',
        'content',
        'file',
        'image',
        'banner_image',
        'status',
    ];
}
