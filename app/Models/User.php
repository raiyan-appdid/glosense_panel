<?php

namespace App\Models;


use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;
    use \Znck\Eloquent\Traits\BelongsToThrough;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'google_id',
        'phone',
        'image',
        'address',
        'address_one',
        'state_id',
        'city',
        'pincode',
        'gender',
        'firebase_uid',
        'status',
        'device_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'isAdmin',
        'firebase_uid',
        'device_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeWithoutAdmin($query)
    {
        return $query->where('isAdmin', '0');
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
