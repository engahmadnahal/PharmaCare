<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class SubOptionPosterprintService extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function package(){
        return $this->belongsTo(PackgePosterService::class,'packge_poster_service_id','id');
    }

    public function title() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->description_ar : $this->description_en);
    }

    public function priceKey() : Attribute {
        return new Attribute(get:fn() => $this->isPrice ? __('cms.isPrice') : __('cms.free') );
    }

    public function description() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->description_ar : $this->description_en);
    }
    
    public function price(){
        return $this->morphMany(PricingService::class,'object','object_type','object_id');
    }

    public function priceService() : Attribute{
        return new Attribute(get:function(){
            return $this->price->where('currency_id',auth()->user()->currency)->first()?->price ?? 0;
        });
    }

    public function currencyKey() : Attribute{
        return new Attribute(get:function(){
            return $this->price->where('currency_id',auth()->user()->currency)->first()?->currency->code ?? "";
        });
    }

    

    
}
