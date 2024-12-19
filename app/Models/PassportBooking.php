<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportBooking extends Model
{

    protected $casts = [
        'country_id' => 'integer',
        'passport_type_id' => 'integer',
        'quantity' => 'integer',
        
    ];
    protected $guarded = [];

    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function masterService(){
        return $this->belongsTo(PassportService::class,'passport_service_id','id');
    }

    public function masterServiceId() : Attribute{
        return new Attribute(get:fn()=>$this->masterService->id ?? 0);
    }
    
    public function passportType(){
        return $this->belongsTo(PassportType::class,'passport_type_id','id');
    }
    public function images(){
        return $this->morphMany(ImagesService::class,'object','object_type','object_id');
    }
    public function orderStudio(){
        return $this->morphMany(OrderStatus::class,'object','object_type','object_id');
    }
    public function cart(){
        return $this->morphMany(MyCart::class,'object','object_type','object_id');
    }

    public function passportCountry(){
        return $this->belongsTo(PassportCountry::class,'passport_country_id','id');
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }


    public function currencyCode() : Attribute {
        return new Attribute(get: function(){
            return $this->currency?->code ?? '';
        });
    }

}
