<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ServicesBookingStudio extends Model
{
    use HasFactory;


    public function bookinStudioService()
    {
        return $this->belongsTo(BookingStudioService::class, 'booking_studio_service_id', 'id');
    }
    public function title(): Attribute
    {
        return new Attribute(get: fn () => App::getLocale() == 'ar' ? $this->title_ar : $this->title_en);
    }

    public function description(): Attribute
    {
        return new Attribute(get: fn () => App::getLocale() == 'ar' ? $this->description_ar : $this->description_en);
    }
    public function price()
    {
        return $this->morphMany(PricingService::class, 'object', 'object_type', 'object_id');
    }

    public function priceAfterIncres()
    {
        return $this->morphMany(PricePassportAfterIncrese::class, 'object', 'object_type', 'object_id');
    }




    public function priceAfterIncresKey(): Attribute
    {
        return new Attribute(get: function () {
            return $this->priceAfterIncres?->where('currency_id', auth()->user()->currency)->first()?->price ?? 0;
        });
    }

    public function priceAfterIncresCode(): Attribute
    {
        return new Attribute(get: function () {
            return $this->priceAfterIncres?->where('currency_id', auth()->user()->currency)->first()?->currency?->code ?? "";
        });
    }


    public function priceKey(): Attribute
    {
        return new Attribute(get: function () {
            return $this->price->where('currency_id', auth()->user()->currency)->first()?->price ?? 0;
        });
    }

    public function priceCode(): Attribute
    {
        return new Attribute(get: function () {
            return $this->price?->where('currency_id', auth()->user()->currency)->first()?->currency?->code ?? "";
        });
    }
}
