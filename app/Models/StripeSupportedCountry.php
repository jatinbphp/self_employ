<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeSupportedCountry extends Model
{
    use HasFactory;

    protected $fillable = ['country_code','country_currency','country_name'];
}
