<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class NotificationFcmUser extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function title() : Attribute {

        return new Attribute(get:function(){
            return App::getLocale() == 'ar' ? $this->title_ar : $this->title_en;
        });
    }

    public function body() : Attribute {

        return new Attribute(get:function(){
            return App::getLocale() == 'ar' ? $this->body_ar : $this->body_en;
            
        });
    }
}
