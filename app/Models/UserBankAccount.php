<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBankAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id','business_type','first_name','last_name','country','address','city','zip_code','state','bank_holder_name',
        'bank_account_number','bank_routing_number','stripe_account_id','stripe_bank_account_id','stripe_external_account_id','status'];

}
