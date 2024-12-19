<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FramesSize extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function title(): Attribute
    {
        return new Attribute(get: fn () => "Size - W : {$this->width} * H: {$this->height}");
    }
    public function option()
    {
        return $this->belongsTo(FramesOrAlbum::class, 'frames_or_album_id', 'id');
    }
    public function price()
    {
        return $this->morphMany(PricingService::class, 'object', 'object_type', 'object_id');
    }

    public function qsSize()
    {
        return $this->hasOne(SizeQsFrameAlbume::class, 'frames_size_id', 'id');
    }


    public function booking()
    {
        return $this->hasMany(FrameAlbumBooking::class, 'frames_size_id', 'id');
    }
}
