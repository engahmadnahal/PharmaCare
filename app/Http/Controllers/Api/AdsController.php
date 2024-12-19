<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdsResource;
use App\Http\Resources\Api\SuccessResponse;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    //

    public function getAllAds(){

        $data = Ads::where('active',true)->get();
        return response()->json(new SuccessResponse('SUCCESS_GET',AdsResource::collection($data)));
    }
}
