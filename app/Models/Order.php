<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class,'coupon_id','id');
    }

    public function items(){
        return $this->hasMany(OrderItem::class);
    }

}
