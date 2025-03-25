<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\PharmaResource;
use App\Models\Pharmaceutical;
use Illuminate\Http\Request;

class PharmaController extends Controller
{
    public function index()
    {
        $data = Pharmaceutical::select('id', 'name_ar', 'name_en')->where('status', 1)->get();

        return ControllersService::successResponse(
            __('cms.pharmacies_retrieved_successfully'),
            PharmaResource::collection($data)
        );
    }
}
