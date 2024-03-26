<?php

namespace App\Models;
use App\Events\StatusOnline;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [];

    protected $dispatchesEvents = [

        'created' => StatusOnline::class,

    ];

    protected $appends = ['profile_image', 'name', 'cover_image', 'last_login', 'last_login2', 'created', 'updated', 'user_address', 'billing_address', 'shipping_address', 'language'];
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 'password', 'phone',
        'address', 'address2', 'city', 'zip_code', 'state', 'country',
        'cover', 'image', 'about', 'company_name', 'designation', 'category_id','subcategory_id',
        'language_id', 'status', 'last_login_ip','facebook_id', 'role_id', 'balance','is_deactivate'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'identity_verified_at' => 'datetime',
        'payment_verified_at' => 'datetime',
        'last_login_at' => 'datetime'
    ];

    const BType1 = 'individual';
    const BType2 = 'company';

    public static $businessType = [
        self::BType1 => 'Individual',
        self::BType2 => 'Company',
    ];

    /**
     * Relationship and data get against foriegn key and primary key.
     *
     * Relational Data relationship linked tables
     *
     */

    //Relations on User Model

    public function chat_messages_send()
    {
        return $this->hasMany(Message::class, 'to_user', 'id');
        //return $this->hasMany('chat_messages', 'sender_id', 'id');
    }

    public function chat_messages_receive()
    {
        return $this->hasMany(Message::class, 'from_user', 'id');
    }

    public function getRoles()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id')->withDefault();
    }

    public function getJobPosted()
    {
        return $this->hasMany(Post::class, 'user_id', 'id'); //->withDefault();
    }
    public function getUserLoginHistory()
    {
        return $this->hasMany(UserLoginHistory::class, 'user_id', 'id'); //->withDefault();
    }
    public function getUserLastActivity()
    {
        return $this->belongsTo(LoginDetailActivity::class, 'user_id', 'id');
    }

    /**
     * The get Fullname attribute
     *
     * @var array<string, string>
     */

    public function getNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    /**
     * The get Profile Url attribute
     *
     * @var array<string, string>
     */
    public function getProfileImageAttribute()
    {
        return env('APP_URL') . 'uploads/user/user_profile/' . $this->image;
    }

    /**
     * The get Profile Url attribute
     *
     * @var array<string, string>
     */
    public function getCoverImageAttribute()
    {
        return env('APP_URL') . 'uploads/user/user_cover/' . $this->cover;
    }

    /**
     * The get Created at human read able attribute
     *
     * @var array<string, string>
     */
    public function getLastLoginAttribute()
    {
        return Carbon::parse($this->last_login_at)->diffForHumans();
    }
    /**
     * The get Created at human read able attribute
     *
     * @var array<string, string>
     */
    public function getLastLogin2Attribute()
    {

        return Carbon::parse($this->last_login_at)->format('d M, Y g:i A');
    }
    /**
     * The get Created at human read able attribute
     *
     * @var array<string, string>
     */
    public function getUserAddressAttribute()
    {
        if (!is_null($this->city) && !is_null($this->state) && !is_null($this->country) )return $this->city . ', ' . $this->state . ', ' . $this->country;
        else return "";
    }

    /**
     * The get Created at human read able attribute
     *
     * @var array<string, string>
     */
    public function getCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M, Y');
    }

    /**
     * The get Updated at human read able attribute
     *
     * @var array<string, string>
     */
    public function getUpdatedAttribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }
    /**
     * The get Updated at human read able attribute
     *
     * @var array<string, string>
     */
    public function getLanguageAttribute()
    {
        switch ($this->language_id) {
            case (1):
                $language = 'English';
                break;
            case (2):
                $language = 'Swedish';
                break;
            default:
                $language = 'English';
        }
        return $language;
    }


    /**
     * The get Updated at human read able attribute
     *
     * @var array<string, string>
     */
    public function getBillingAddressAttribute()
    {
        $address = '';
        if (!is_null($this->address)) {
            $address .= $this->address;
        }
        if (!is_null($this->address2)) {
            $address .= ', ' . $this->address;
        }
        if (!is_null($this->city)) {
            $address .= ', ' . $this->city;
        }
        if (!is_null($this->state)) {
            $address .= ', ' . $this->state;
        }
        if (!is_null($this->country)) {
            $address .= ', ' . $this->country;
        }
        if (!is_null($this->zip_code)) {
            $address .= ', ' . $this->zip_code;
        }

        return $address;
    }

    /**
     * The get Updated at human read able attribute
     *
     * @var array<string, string>
     */
    public function getShippingAddressAttribute()
    {
        $address = '';
        if (!is_null($this->address)) {
            $address .= $this->address;
        }
        if (!is_null($this->address2)) {
            $address .= ', ' . $this->address;
        }
        if (!is_null($this->city)) {
            $address .= ', ' . $this->city;
        }
        if (!is_null($this->state)) {
            $address .= ', ' . $this->state;
        }
        if (!is_null($this->country)) {
            $address .= ', ' . $this->country;
        }
        if (!is_null($this->zip_code)) {
            $address .= ', ' . $this->zip_code;
        }

        return $address;
    }

    /**
     * The Password attribute should set with Hash
     *
     * @var array<string, string>
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * The email to lower attribute should set
     *
     * @var array<string, string>
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
}
