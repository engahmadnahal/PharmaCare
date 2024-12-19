<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class PassportService extends Model
{
    use HasFactory;

    // protected $with = [
    //     'price'
    // ];

    protected $guarded = [];

    public function title() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->title_ar : $this->title_en);
    }

    public function description() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->description_ar : $this->description_en);
    }

    public function activeKey() : Attribute {
        return new Attribute(get:fn() => $this->active ? __('cms.activate') : __('cms.unActive'));
    }

    public function soonKey() : Attribute {
        return new Attribute(get:fn() => $this->soon ? __('cms.activate') : __('cms.unActive'));
    }

    public function type() : Attribute {
        return new Attribute(get:fn() => 'passport');
    }

    public function price(){
        return $this->morphMany(PricingService::class,'object','object_type','object_id');
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
   

    public function options(){
        return $this->hasMany(PassportOption::class);
    }

    public function rates(){
        return $this->hasMany(PassportRate::class,'passport_service_id','id');
    }

    public function serviceCat(){
        return $this->belongsTo(ServiceStudio::class,'service_studio_id','id');
    }
    
}
