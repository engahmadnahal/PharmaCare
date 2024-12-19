<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function name() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->name_ar : $this->name_en);
    }

    public function activeKey() : Attribute {
        return new Attribute(get:fn() => $this->active ? __('cms.activate') : __('cms.unActive'));
    }
    
    public function cities(){
        return $this->hasMany(City::class);
    }

    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id','id');
    }

    public function passportTypes(){
        return $this->belongsToMany(PassportType::class,'passport_type_countries','country_id','passport_type_id');
    }
}
