<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_users', 'user_id', 'coupon_id');
    }

    public function findForPassport($username)
    {
        return $this->where('mobile', $username)->first();
    }

    public function info()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function drugs()
    {
        return $this->hasMany(UserDrug::class);
    }

    public function medicalrecords()
    {
        return $this->hasMany(UserMedicalRecord::class);
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany(User::class, 'parent_id');
    }
}
