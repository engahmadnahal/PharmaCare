<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrameAlbumBooking extends Model
{
    use HasFactory;

    protected $casts = [
        'frames_size_id' => 'integer',
        'album_size_id' => 'integer',
        'quantity' => 'integer',
    ];
    protected $guarded = [];


    public function currency() {
        return $this->belongsTo(Currency::class);
    }


    public function currencyCode() : Attribute {
        return new Attribute(get: function(){
            return $this->currency?->code ?? '';
        });
    }
    
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    
    public function size(){
        if($this->type == 'frame'){
            return $this->belongsTo(FramesSize::class,'frames_size_id','id');
        }
        return $this->belongsTo(AlbumSize::class,'album_size_id','id');
    }
    public function frameOrAlbum(){
        return $this->belongsTo(FramesOrAlbum::class,'frames_or_album_id','id');
    }

    public function images(){
        return $this->morphMany(ImagesService::class,'object','object_type','object_id');
    }
    public function cart(){
        return $this->morphMany(MyCart::class,'object','object_type','object_id');
    }

    public function masterService(){
        return $this->belongsTo(FrameAlbumService::class,'frame_album_service_id','id');
    }

    public function masterServiceId() :Attribute{
        return new Attribute(get:fn()=>$this->frameOrAlbum->sizeOrtype->service->id);
    }
    public function orderStudio(){
        return $this->morphMany(OrderStatus::class,'object','object_type','object_id');
    }
    
}
