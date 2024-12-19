<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class QsFramesAlbum extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function framesOrAlbum(){
        return $this->belongsTo(FramesOrAlbum::class,'frames_or_album_id','id');
    }
    public function qs() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->qs_ar : $this->qs_en);
    }

    public function price(){
        return $this->morphMany(PricingService::class,'object','object_type','object_id');
    }
    
}
