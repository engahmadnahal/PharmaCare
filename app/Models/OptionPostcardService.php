<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class OptionPostcardService extends Model
{
    use HasFactory;


    public function title() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->title_ar : $this->title_en);
    }

    public function activeKey() : Attribute {
        return new Attribute(get:fn() => $this->active ? __('cms.activate') : __('cms.unActive'));
    }
    public function service(){
        return $this->belongsTo(PostcardService::class,'postcard_service_id','id');
    }


    public function subOptions(){
        return $this->hasMany(SubOptionPostcardService::class,'option_postcard_service_id' ,'id');
    }

    public function price(){
        return $this->morphMany(PricingService::class,'object','object_type','object_id');
    }

    public function priceData() : Attribute{
        return new Attribute(get:function(){
            return $this->subOptions?->first()?->price->where('currency_id',auth()->user()->currency)?->first();
        });
    }
}
