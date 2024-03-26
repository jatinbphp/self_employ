<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakeOffer extends Model
{
    use HasFactory;
    protected $table = 'make_offers';
    protected $fillable = ['user_id', 'post_id', 'post_user_id', 'amount', 'description', 'status'];

    public function getOfferUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
