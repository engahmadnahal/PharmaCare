<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class StudioBranch extends Authenticatable
{
    use HasFactory,HasRoles,Notifiable,SoftDeletes;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];
    
    public function city(){
        return $this->belongsTo(City::class);
    }

    public function activeKey() : Attribute {
        return new Attribute(get:fn() => $this->active ? __('cms.activate') : __('cms.unActive'));
    }


    public function currency() {
        return $this->belongsTo(Currency::class,'currency_id','id');
    }

    

    public function currencyCode() : Attribute {
        return new Attribute(get: function(){
            return $this->currency->code;
        });
    }


    public function isAcceptableKey() : Attribute {
        return new Attribute(get:function(){
            if($this->isAcceptable == 'accept'){
                return __('cms.accept');
            }else if($this->isAcceptable == 'wait'){
                return __('cms.waiting');
            }else{
                return __('cms.unAccept');
            }
        });
    }

    public function services(){
        return $this->belongsToMany(ServiceStudio::class,'studio_services','studio_branch_id','service_studio_id');
    }

    public function bookginServicesStudio(){
        return $this->belongsToMany(ServicesBookingStudio::class,'services_booking_studio_branches','studio_branch_id','services_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class,'studio_products','studio_branch_id','product_id');
    }

    public function orders(){
        return $this->hasMany(Order::class,'studio_branch_id','id');
    }
    
}
