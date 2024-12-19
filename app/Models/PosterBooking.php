<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosterBooking extends Model
{
    use HasFactory;

    protected $casts = [
        'print_choices_id' => 'integer',
        'frame_choices_id' => 'integer',
        'print_color_choices_id' => 'integer',
        'copies' => 'integer',
        'photo_num' => 'integer',
    ];
    protected $guarded = [];


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }


    public function currency() {
        return $this->belongsTo(Currency::class);
    }


    public function currencyCode() : Attribute {
        return new Attribute(get: function(){
            return $this->currency?->code ?? '';
        });
    }
    
    public function masterService(){
        return $this->belongsTo(PosterprintService::class,'posterprint_service_id','id');
    }
    public function masterServiceId() :Attribute{
        return new Attribute(get:fn()=>$this->package->size->service->id);
    }

    public function sizeTitle() : Attribute{
        return new Attribute(get:fn() => $this->package->size->title); 
    }
    public function package(){
        return $this->belongsTo(PackgePosterService::class,'packge_poster_service_id','id');
    }

    public function images(){
        return $this->morphMany(ImagesService::class,'object','object_type','object_id');
    }
    public function cart(){
        return $this->morphMany(MyCart::class,'object','object_type','object_id');
    }
    public function orderStudio(){
        return $this->morphMany(OrderStatus::class,'object','object_type','object_id');
    }

    public function printType(){
        return $this->belongsTo(SubOptionPosterprintService::class,'print_choices_id','id');
    }

    public function frameType(){
        return $this->belongsTo(SubOptionPosterprintService::class,'frame_choices_id','id');
    }

    public function printColor(){
        return $this->belongsTo(SubOptionPosterprintService::class,'print_color_choices_id','id');
    }


}
