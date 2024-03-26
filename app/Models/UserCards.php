<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCards extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id','card_number','expiry_month','token','status'];
}
