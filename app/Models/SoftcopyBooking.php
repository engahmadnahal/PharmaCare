<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftcopyBooking extends Model
{
    use HasFactory;

    public function masterService() : Attribute{
        return new Attribute(get:fn() => $this->softcopy);
    }

    public function masterServiceId() : Attribute{
        return new Attribute(get:fn() => $this->softcopy->id);
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function softcopy(){
        return $this->belongsTo(SoftCopyService::class,'soft_copy_service_id','id');
    }
    public function images(){
        return $this->morphMany(ImagesService::class,'object','object_type','object_id');
    }
    public function cart(){
        return $this->morphMany(MyCart::class,'object','object_type','object_id');
    }

                                
    public function accepteKey() : Attribute {
        return new Attribute(get:fn() => $this->accepted ? __('cms.accept') : __('cms.unAccept'));
    }         
    
    public function price(){
        return $this->morphMany(PricingService::class,'object','object_type','object_id');
    }

    public function confirmed(){
        return $this->hasOne(SoftcopyConfirm::class,'softcopy_booking_id','id');
    }

    public function order(){
        return $this->hasOne(Order::class,'softcopy_booking_id','id');
    }

}
