<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class OptionPosterprintService extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function title() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->title_ar : $this->title_en);
    }

    public function activeKey() : Attribute {
        return new Attribute(get:fn() => $this->active ? __('cms.activate') : __('cms.unActive'));
    }
    
    
    public function service(){
        return $this->belongsTo(PosterprintService::class,'posterprint_service_id','id');
    }

    // public function subOptions(){
    //     return $this->hasMany(SubOptionPosterprintService::class,'');
    // }



    public function price(){
        return $this->morphMany(PricingService::class,'object','object_type','object_id');
    }
  

    public function package(){
        return $this->hasMany(PackgePosterService::class,'option_posterprint_service_id','id');
    }
    
    public function priceData() : Attribute{
        return new Attribute(get:function(){
            return $this->package?->first()?->price?->where('currency_id',auth()->user()->currency)?->first();
        });
    }

    
}
