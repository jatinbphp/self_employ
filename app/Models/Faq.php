<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    protected $appends = ['created'];
    protected $table = 'faqs';

    protected $fillable = ['question', 'answer', 'status'];

    public function getCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M, Y');
    }
}
