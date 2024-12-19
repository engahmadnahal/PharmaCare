<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class OwnerStudio extends Authenticatable
{
    use HasFactory,HasRoles;


    protected $guarded = [];
    public function activeKey() : Attribute {
        return new Attribute(get:fn() => $this->active ? __('cms.activate') : __('cms.unActive'));
    }
    
    
    public function name() : Attribute {
        return new Attribute(get:fn() => $this->fname );
    }

    public function fullName() : Attribute {
        return new Attribute(get:fn() => $this->fname . ' '. $this->lname);
    }

    public function studios(){
        return $this->hasMany(Studio::class,'owner_studio_id','id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }
    public function region(){
        return $this->belongsTo(Region::class,'region_id','id');
    }


}
