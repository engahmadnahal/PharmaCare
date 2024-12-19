<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricePassportAfterIncrese extends Model
{
    use HasFactory;

    protected $casts = [
        'price' => 'double'
    ];

    protected $guarded = [];
    public function object(){
        return $this->morphTo();
    }

    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id','id');
    }
}
