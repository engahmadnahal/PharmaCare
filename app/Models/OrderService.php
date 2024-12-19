<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    use HasFactory;


    protected $casts = [
        'rate' => 'string'
    ];
    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
    public function object(){
        return $this->morphTo();
    }
}
