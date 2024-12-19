<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosterRate extends Model
{
    use HasFactory;
    protected $casts = [
        'rate' => 'double'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function service(){
        return $this->belongsTo(PosterprintService::class,'posterprint_service_id','id');
    }
}
