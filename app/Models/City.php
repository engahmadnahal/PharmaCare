<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class City extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function name() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->name_ar : $this->name_en);
    }
    
    public function activeKey() : Attribute {
        return new Attribute(get:fn() => $this->active ? __('cms.activate') : __('cms.unActive'));
    }
    public function regions(){
        return $this->hasMany(Region::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function price(){
        return $this->morphMany(PricingService::class,'object','object_type','object_id');
    }

    public function orders(){
        return $this->hasMany(Order::class,'city_id','id');
    }
}
