<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeQsFrameAlbume extends Model
{
    use HasFactory;

    public function price(){
        return $this->morphMany(PricingService::class,'object','object_type','object_id');
    }

    public function frameSize(){
        return $this->belongsTo(FramesSize::class,'frames_size_id','id');
    }

    public function albumSize(){
        return $this->belongsTo(AlbumSize::class,'album_size_id','id');
    }

    public function qs(){
        return $this->belongsTo(QsFramesAlbum::class,'qs_frames_album_id','id');
    }
}
