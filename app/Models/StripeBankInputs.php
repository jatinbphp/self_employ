<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeBankInputs extends Model
{
    use HasFactory;

    protected $fillable = ['country_name', 'country_code', 'country_currency'];
}
