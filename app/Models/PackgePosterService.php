<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class PackgePosterService extends Model
{
    use HasFactory;

    protected $casts = [
        'min_item' => 'integer'
    ];


    public function sertviceType() : Attribute {
        return new Attribute(get: fn() => 'posters');
    }

    public function size(){
        return $this->belongsTo(OptionPosterprintService::class,'option_posterprint_service_id','id');
    }
    public function title() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->description_ar : $this->description_en);
    }
    public function description() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->description_ar : $this->description_en);
    }
    public function price(){
        return $this->morphMany(PricingService::class,'object','object_type','object_id');
    }

    public function options(){
        return $this->hasMany(SubOptionPosterprintService::class,'packge_poster_service_id','id');
    }


    public function bookings(){
        return $this->hasMany(PosterBooking::class,'packge_poster_service_id','id');
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
