<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostcardBooking extends Model
{
    use HasFactory;

    protected $casts = [
        'copies' => 'integer',
        'photo_num' => 'integer',
    ];
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function masterService(){
        return $this->belongsTo(PostcardService::class,'postcard_service_id','id');
    }
    public function masterServiceId() :Attribute{
        return new Attribute(get:fn()=>$this->subOptions->sizeOrtype->service->id);
    }

    public function sizeTitle() : Attribute{
        return new Attribute(get:fn() => $this->subOptions->sizeOrtype->title); 
    }
    public function subOptions(){
        return $this->belongsTo(SubOptionPostcardService::class,'sub_option_postcard_service_id','id');
    }

    public function images(){
        return $this->morphMany(ImagesService::class,'object','object_type','object_id');
    }
    public function cart(){
        return $this->morphMany(MyCart::class,'object','object_type','object_id');
    }

    public function orderService(){
        return $this->morphMany(OrderService::class,'object','object_type','object_id');
    }

    public function orderStudio(){
        return $this->morphMany(OrderStatus::class,'object','object_type','object_id');
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
