<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class PassportType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function title() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->title_ar : $this->title_en);
    }

    public function activeKey() : Attribute {
        return new Attribute(get:fn() => $this->active ? __('cms.activate') : __('cms.unActive'));
    }

    public function passportOption(){
        return $this->hasMany(PassportOption::class,'passport_type_id','id');
    }

    public function countries(){
        return $this->belongsToMany(PassportCountry::class,'passport_type_countries','passport_type_id','passport_country_id');
    }

    public function bookings(){
        return $this->hasMany(PassportBooking::class,'passport_type_id','id');
    }
}
