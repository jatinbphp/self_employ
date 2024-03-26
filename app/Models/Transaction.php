<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $appends = [];

    protected $table = "transaction";

    protected $fillable = ["amount", "user_id", "type", 'created_at','payment_type'];

    public function getDepositor()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}


