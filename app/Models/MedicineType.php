<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\App;

class MedicineType extends Model
{
    use HasFactory;

    public function name(): Attribute
    {
        return new Attribute(get: fn() => App::getLocale() == 'ar' ? $this->name_ar : $this->name_en);
    }
}
