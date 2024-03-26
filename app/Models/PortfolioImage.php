<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioImage extends Model
{
    use HasFactory;
    protected $appends = ['portfolio_images'];
    protected $table = 'portfolio_images';

    protected $fillable = [
        'image',
        'portfolio_id'
    ];

    public function getPortfolioImagesAttribute()
    {
        return env('APP_URL') . 'uploads/portfolio/portfolio_images/' . $this->image;
    }
}
