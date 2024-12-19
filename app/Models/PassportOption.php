<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class PassportOption extends Model
{
    use HasFactory;

    protected $casts = [
        'discount_value'        => 'double',
        'num_photo'             => 'integer',
        'num_add'               => 'integer',
        'price_elm_percentage'  => 'double',
    ];

    public function title(): Attribute
    {
        return new Attribute(get: fn () => App::getLocale() == 'ar' ? $this->title_ar : $this->title_en);
    }

    public function noteKey(): Attribute
    {
        return new Attribute(get: fn () => App::getLocale() == 'en' ? $this->note_en : $this->note);
    }

    public function passport()
    {
        return $this->belongsTo(PassportService::class, 'passport_service_id', 'id');
    }
    public function type()
    {
        return $this->belongsTo(PassportType::class, 'passport_type_id', 'id');
    }
    public function country()
    {
        return $this->belongsTo(PassportCountry::class, 'passport_country_id', 'id');
    }
    public function price()
    {
        return $this->morphMany(PricingService::class, 'object', 'object_type', 'object_id');
    }

    public function discount(): Attribute
    {
        return new Attribute(get: fn () => floatval(number_format($this->discount_value, 2)));
    }

    public function priceAfterIncres()
    {
        return $this->morphMany(PricePassportAfterIncrese::class, 'object', 'object_type', 'object_id');
    }
}
