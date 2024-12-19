<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudioBooking extends Model
{
    use HasFactory;

    protected $casts = [
        'qty' => 'integer'
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
    
    public function masterService() : Attribute{
        return new Attribute(get:fn() => $this->service?->bookinStudioService);
    }

    public function service(){
        return $this->belongsTo(ServicesBookingStudio::class,'services_booking_studio_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function studio(){
        return $this->belongsTo(StudioBranch::class,'studio_id','id');
    }
    public function cart(){
        return $this->morphMany(MyCart::class,'object','object_type','object_id');
    }
}
