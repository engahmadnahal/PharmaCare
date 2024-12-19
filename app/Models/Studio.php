<?php

namespace App\Models;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Studio extends Authenticatable
{
    use HasFactory,HasRoles,Notifiable,SoftDeletes;


    public function defaultAddressString() : Attribute {
        return new Attribute(get:function(){
            $address = "";
            $address .= $this->city?->country?->name ?? '';
            $address .= " ," .$this?->city?->name ?? '';
            $address .= " ," .$this?->region?->name ?? '';
            $address .= " ," .$this?->address ?? '';
            return $address;
        });
       }


       public function region(){
        return $this->belongsTo(Region::class);
    }


    public function city(){
        return $this->belongsTo(City::class);
    }

    public function activeKey() : Attribute {
        return new Attribute(get:fn() => $this->active ? __('cms.activate') : __('cms.unActive'));
    }

    public function owner(){
        return $this->belongsTo(Studio::class,'owner_studio_id','id');
    }


    public function main(){
        return $this->belongsTo(Store::class,'parent_id','id');
    }

    public function branches(){
        return $this->hasMany(Store::class,'parent_id','id');
    }

    public function currencyCode() : Attribute {
        return new Attribute(get: function(){
            return $this->city?->country?->currency?->code ?? "";
        });
    }
    
}
