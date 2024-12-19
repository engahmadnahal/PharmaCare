<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStudio extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function status(){
    //     return $this->belongsTo(OrderStatus::class,'order_status_id','id');
    // }
    public function object(){
        return $this->morphTo();
    }
}
