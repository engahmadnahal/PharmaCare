<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostcardRate extends Model
{
    use HasFactory;
    protected $casts = [
        'rate' => 'double'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function service(){
        return $this->belongsTo(PostcardService::class,'postcard_service_id','id');
    }
}
