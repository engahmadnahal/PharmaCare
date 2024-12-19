<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class OptionFrameAlbumService extends Model
{
    use HasFactory;


    protected $guarded = [];
    public function title(): Attribute
    {
        return new Attribute(get: fn () => App::getLocale() == 'ar' ? $this->title_ar : $this->title_en);
    }

    public function activeKey(): Attribute
    {
        return new Attribute(get: fn () => $this->active ? __('cms.activate') : __('cms.unActive'));
    }
    public function subOptions()
    {
        return $this->hasMany(FramesOrAlbum::class);
    }

    public function service()
    {
        return $this->belongsTo(FrameAlbumService::class, 'frame_album_service_id', 'id');
    }

    public function price()
    {
        return $this->morphMany(PricingService::class, 'object', 'object_type', 'object_id');
    }

    public function priceData(): Attribute
    {
        return new Attribute(get: function () {

            if ($this->type == 'frame') {
                $price = FramesOrAlbum::where('option_frame_album_service_id', $this->id)
                ->where('type','frame')->whereHas('frameSizes', function ($q) {
                    $q->whereHas('product', function ($q) {
                        $q->whereHas('price', function ($q) {
                            $q->where('currency_id', auth()->user()->currency)->orderBy('price');
                        });
                    });
                })->first();
                return $price?->priceData;
            }
            $albumPrice = FramesOrAlbum::where('option_frame_album_service_id', $this->id)
            ->where('type','album')
            ->whereHas('albumSizes', function ($q) {
                $q->whereHas('product', function ($q) {
                    $q->whereHas('price', function ($q) {
                        $q->where('currency_id', auth()->user()->currency)->orderBy('price');
                    });
                });
            })->first();
            return $albumPrice?->priceData;
        });
    }
}
