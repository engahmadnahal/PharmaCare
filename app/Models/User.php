<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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

    public function cart(){
        return $this->hasOne(MyCart::class,'user_id','id');
    }
    
    public function defaultAddressString() : Attribute {
        return new Attribute(get:function(){
            $defAdrss = $this->defaultAddress;
            $address = "";
            $address .= $defAdrss->title ?? '';
            $address .= " ," .$defAdrss?->country?->name ?? '';
            $address .= " ," .$defAdrss?->city?->name ?? '';
            $address .= " ," .$defAdrss?->details ?? '';
            return $address;
        });
       }

   public function defaultAddress() : Attribute {
    return new Attribute(get:fn() => $this->userAddress()->where('isDefault',true)->first());
   }

   public function country(){
    return $this->hasOneThrough(Country::class,UserAddress::class,'country_id','id');
}

    public function userAddress(){
        return $this->hasMany(UserAddress::class,'user_id','id');
    }

    public function currencyTh() : Attribute {
        return new Attribute(get: function(){
            return $this->country?->currency ;
        });
    }

    public function currency() : Attribute {
        return new Attribute(get: function(){
            return $this->userAddress()->where('isDefault',true)->first()?->country->currency_id;
        });
    }

    public function tax() : Attribute {
        return new Attribute(get: function(){
            $tax = ($this->userAddress->where('isDefault',true)->first())->country->tax;
            return $tax;
        });
    }

    public function currencyCode() : Attribute {
        return new Attribute(get: function(){
            $crr = Currency::where('id',$this->currency)->first();
            return $crr?->code ?? '--';
        });
    }

    public function isSelectedAddress() : Attribute {
        return new Attribute(get: function(){
            $address = $this->userAddress->where('isDefault',true)->first();
            return !is_null($address);
        });
    }

    public function findForPassport($username)
    {
        return $this->where('mobile', $username)->first();
    }

    public function myCart(){
        return $this->hasMany(MyCart::class,'user_id','id');
    }

    public function postcardRate(){
        return $this->hasMany(PostcardRate::class,'user_id','id');
    }

    public function posterRate(){
        return $this->hasMany(PosterRate::class,'user_id','id');
    }

    public function passportRate(){
        return $this->hasMany(PassportRate::class,'user_id','id');
    }

    public function frameRate(){
        return $this->hasMany(FrameAlbumRate::class,'user_id','id');
    }


    public function statusKey() : Attribute{
        return new Attribute(get:fn() => __('cms.'.$this->status));
    }


    public function deliveryPrice() : Attribute{
        return new Attribute(function(){
            $city = City::find($this->defaultAddress?->city_id);
            $price = $city?->price?->where('currency_id',$this->currency)->first()?->price ?? number_format(5,2);
            return $price;
        });
    }

   
    public function fcms() {
        return $this->hasMany(MobileToken::class,'user_id','id');
    }
}
