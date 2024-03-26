<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoginHistory extends Model
{
    use HasFactory;
    protected $table = 'user_login_histories';
    protected $appends = ['last_login','current_sesison'];
    protected $fillable = [
        'user_id',
        'country_code',
        'country',
        'city',
        'region_name',
        'browser',
        'last_login_ip',
        'last_login_at',
        'logout_at',
        'status',
    ];

    /**
     * The get Created at human read able attribute
     *
     * @var array<string, string>
     */
    public function getLastLoginAttribute()
    {
        return Carbon::parse($this->last_login_at)->diffForHumans();
    }

    public function getCurrentSessionAttribute()
    {
        switch ($this->status) {
            case ('active'):
                $current_session = 'Currently Logged In';
                break;
            case ('logout'):
                $current_session = 'Logout';
                break;
            case ('expired'):
                $current_session = 'Expired';
                break;
            default:
                $current_session = '';
        }
        return $current_session;
    }
}
