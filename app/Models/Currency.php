<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Currency extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function name() : Attribute {
        return new Attribute(get:fn() => App::getLocale() == 'ar' ? $this->name_ar : $this->name_en);
    }

    public function countries(){
        return $this->hasMany(Country::class,'currency_id','id');
    }
}
