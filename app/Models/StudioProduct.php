<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudioProduct extends Model
{
    use HasFactory;

    public function studio(){
        return $this->belongsTo(StudioBranch::class,'studio_branch_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
