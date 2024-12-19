<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ServiceStudio extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function name() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->name_ar : $this->name_en);
    }

    public function activeKey() : Attribute {
        return new Attribute(get:fn() => $this->active ? __('cms.activate') : __('cms.unActive'));
    }

    public function studios(){
        return $this->belongsToMany(StudioBranch::class,'studio_services','service_studio_id','studio_branch_id');
    }

    public function price(){
        return $this->morphMany(PricingService::class,'object','object_type','object_id');
    }
}
