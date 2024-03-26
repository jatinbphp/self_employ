<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginDetailActivity extends Model
{
    use HasFactory;

    protected $table = "login_detail_activities";
    protected $fillable = ["login_details_id", "user_id", "last_activity", "is_type"];
}
