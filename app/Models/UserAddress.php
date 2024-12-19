<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    

    public function fullAddress() : Attribute{
        return new Attribute(get:fn() => "{$this->country->name} - {$this->city->name} / {$this->details}");
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function orders(){
        return $this->hasMany(Order::class,'user_address_id','id');
    }
}
