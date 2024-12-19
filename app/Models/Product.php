<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'num_items' => 'integer'
    ];
    public function name() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->name_ar : $this->name_en);
    }

    public function description() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->description_ar : $this->description_en);
    }


    public function activeKey() : Attribute {
        return new Attribute(get:fn() => $this->active ? __('cms.activate') : __('cms.unActive'));
    }
    
    public function storehouse(){
        return $this->belongsTo(StoreHouse::class,'store_house_id','id');
    }

    public function studioProduct(){
        return $this->hasMany(StudioProduct::class,'product_id','id');
    }
    public function price(){
        return $this->morphMany(PricingService::class,'object','object_type','object_id');
    }

    public function joomla(){
        return $this->hasMany(JomlaPriceProduct::class,'product_id','id');
    }

    public function joomlaKey() : Attribute {
        return new Attribute(function(){
            return $this->joomla?->where('currency_id',auth()->user()?->currency?->id)->first()?->price ?? 0;
        });
    }


    public function joomlaString() : Attribute {
        return new Attribute(function(){
            return $this->joomla?->where('currency_id',auth()->user()->currency->id)->first()?->price . " " . auth()->user()->currencyCode;
        });
    }
    

    public function priceCurrencyId() : Attribute {
        return new Attribute(function(){
            return $this->price?->where('currency_id',auth()->user()->currency)->first()?->currency->code ?? "";
        });
    }

    public function priceCurrencyCode() : Attribute {
        return new Attribute(function(){
            return $this->price?->where('currency_id',auth()->user()->currency)->first()?->currency->code ?? "";
        });
    }

    public function priceKey() : Attribute {
        return new Attribute(function(){
            return $this->price?->where('currency_id',auth()->user()->currency)->first()?->price ?? 0;
        });
    }


    public function currencyKey() : Attribute {
        return new Attribute(function(){
            return $this->price?->where('currency_id',auth()->user()->currency)->first()?->currency->code ?? "";
        });
    }
}
