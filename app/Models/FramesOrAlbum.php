<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class FramesOrAlbum extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sizeOrtype(){
        return $this->belongsTo(OptionFrameAlbumService::class,'option_frame_album_service_id','id');
    }

    public function title() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->title_ar : $this->title_en);
    }

    public function note() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->note_ar : $this->note_en);
    }

    public function description() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->description_ar : $this->description_en);
    }
    public function frameSizes(){
        return $this->hasMany(FramesSize::class,'frames_or_album_id','id');
    }

    public function albumSizes(){
        return $this->hasMany(AlbumSize::class,'frames_or_album_id','id');
    }

    public function qs(){
        return $this->hasMany(QsFramesAlbum::class,'frames_or_album_id','id');
    }


    public function price(){
        return $this->morphMany(PricingService::class,'object','object_type','object_id');
    }


    public function booking(){
            return $this->hasMany(FrameAlbumBooking::class,'frames_or_album_id','id');
    }

    
    public function priceData() : Attribute{
        return new Attribute(get:function(){

            if($this->type == 'album'){
                $prcieAlbum = AlbumSize::where('frames_or_album_id',$this->id)->whereHas('product',function($q){
                    $q->whereHas('price',function($q){
                        $q->where('currency_id',auth()->user()->currency)->orderBy('price');
                    });
                })?->first()?->product?? 0;
                return $prcieAlbum;
            }
            
            $prcieFrame = FramesSize::where('frames_or_album_id',$this->id)->whereHas('product',function($q){
                $q->whereHas('price',function($q){
                    $q->where('currency_id',auth()->user()->currency)->orderBy('price');
                });
            })?->first()?->product?? 0;
            return $prcieFrame;

            
        });
    }

    
}
