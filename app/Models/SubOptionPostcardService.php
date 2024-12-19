<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class SubOptionPostcardService extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'min_item' => 'integer',
        'num_item_over' => 'integer',
        'discount_value' => 'double',
    ];


    public function sertviceType() : Attribute {
        return new Attribute(get: fn() => 'postcard');
    }

    
    public function sizeOrtype(){
        return $this->belongsTo(OptionPostcardService::class,'option_postcard_service_id','id');
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

    public function priceKey() : Attribute{
        return new Attribute(get:function(){
            return $this->price->where('currency_id',auth()->user()->currency)->first()?->price ?? 0;
        });
    }

    public function currencyKey() : Attribute{
        return new Attribute(get:function(){
            return $this->price->where('currency_id',auth()->user()->currency)->first()?->currency->code ?? "";
        });
    }

    public function bookings(){
        return $this->hasMany(PostcardBooking::class,'sub_option_postcard_service_id','id');
    }
    
}
