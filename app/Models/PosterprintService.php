<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class PosterprintService extends Model
{
    use HasFactory;
    public function serviceCat(){
        return $this->belongsTo(ServiceStudio::class,'service_studio_id','id');
    }
    public function title() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->title_ar : $this->title_en);
    }

    public function about() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->about_ar : $this->about_en);
    }

    public function activeKey() : Attribute {
        return new Attribute(get:fn() => $this->active ? __('cms.activate') : __('cms.unActive'));
    }

    public function soonKey() : Attribute {
        return new Attribute(get:fn() => $this->soon ? __('cms.activate') : __('cms.unActive'));
    }
    
    public function options(){
        return $this->hasMany(OptionPosterprintService::class);
    }

    public function type() : Attribute {
        return new Attribute(get:fn() => 'posterprinting');
    }

    public function rates(){
        return $this->hasMany(PosterRate::class,'posterprint_service_id','id');
    }

   
}
