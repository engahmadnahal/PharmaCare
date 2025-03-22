<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Pharmaceutical extends Model
{
    use HasFactory;


    public function parent()
    {
        return $this->belongsTo(Pharmaceutical::class, 'parent_id');
    }

    public function name(): Attribute
    {
        return new Attribute(
            get: fn($value) => app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en,
        );
    }
}
