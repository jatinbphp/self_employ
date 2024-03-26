<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $appends = [];

    protected $table = "transaction";

    protected $fillable = ["payment_type", "user_id", "amount", "description", "type"];

    public function getDepositor()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}


