<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class PromoCode extends Model
{
    use HasFactory;

    protected $casts = [
        'value' => 'integer'
    ];
    public function title() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->title_ar : $this->title_en);
    }

    public function currentBeneficiaries() : Attribute {
        return new Attribute(get:fn() => $this->users->count());
    }

    public function users(){
        return $this->hasMany(PromoCodeUser::class,'promo_code_id','id');
    }


    public function valueKey() : Attribute {
        return new Attribute(get:function(){
            if($this->type == 'fixed'){
                return $this->value;
            }
            return $this->value / 100;
        });
    }


    public function price(){
        return $this->morphMany(PricingService::class,'object','object_type','object_id');
    }

    public function priceKey() : Attribute{
        return new Attribute(get:function(){
            return $this->price->where('currency_id',auth()->user()->currency)->first()?->price ?? 0;
        });
    }
    
    
}
