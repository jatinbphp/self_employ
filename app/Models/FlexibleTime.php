<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlexibleTime extends Model
{
    use HasFactory;

    protected $table = "flexible_times";
    protected $fillable = ["name", "time"];
}
