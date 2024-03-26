<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $appends = ['created', 'post_time', 'due_date', 'member', 'flexible', 'location'];

    protected $table = "posts";

    protected $fillable = ["id","name", "date", "beforedate", "is_flexible", "certain_time", "flexible_time_id", "budget_id", "category_id", "subcategory_id", "user_id", "latitude", "longitude", "address", "address2", "city", "state", "country", "zip_code", "description", "amount", "status"];

    public function getJobPoster()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getBudgetTypes()
    {
        return $this->belongsTo(BudgetType::class, 'budget_id', 'id');
    }

    public function getPostImages()
    {
        return $this->hasMany(PostImage::class, 'post_id', 'id');
    }

    public function getPostSkills()
    {
        return $this->hasMany(PostSkill::class, 'post_id', 'id')->with('getSKills');
    }
    public function getPostCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getPostSubCategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id', 'id');
    }

    public function getOffers()
    {
        return $this->hasMany(MakeOffer::class, 'post_id', 'id')->with('getOfferUser');
    }

    public function getAcceptedOffers()
    {
        return $this->belongsTo(AcceptOffer::class, 'id', 'post_id')->with('getUser');
    }

    /**
     * The get Created at human read able attribute
     *
     * @var array<string, string>
     */
    public function getPostTimeAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    /**
     * The get Created at human read able attribute
     *
     * @var array<string, string>
     */

    public function getLocationAttribute()
    {
        $address = explode(',', $this->address);
        $count = count($address);
        if ($count > 2) {
            $country = $address[$count - 1];
            $city = $address[$count - 3];
            $loc = $city . ', ' . $country;
        } else {
            $loc = $this->address;
        }

        return $loc;
    }
    public function getCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('D, d M, Y');
    }

    /**
     * The get Created at human read able attribute
     *
     * @var array<string, string>
     */
    public function getMemberAttribute()
    {
        return Carbon::parse($this->created_at)->format('d M, Y');
    }

    /**
     * The get Created at human read able attribute
     *
     * @var array<string, string>
     */
    public function getDueDateAttribute()
    {
        return Carbon::parse($this->beforedate)->format('D, d M, Y');
    }
    /**
     * The get Created at human read able attribute
     *
     * @var array<string, string>
     */
    public function getFlexibleAttribute()
    {
        return $this->isflexible == 1 ? 'Yes' : 'No';
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function last_message()
    {
        return $this->hasOne(Message::class)->latest()->with('fromUser', 'toUser');
    }

}
