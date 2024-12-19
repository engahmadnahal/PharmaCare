<?php

namespace App\Http\Controllers;

use App\Http\Resources\Api\SuccessResponse;
use App\Http\Resources\BookingStudioServicesResource;
use App\Models\BookingStudioService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudioBookingController extends Controller
{
    public function bookingStudioService(Request $request,BookingStudioService $bookingStudioService)
    {
            return response()->json(new SuccessResponse('SUCCESS_GET',new BookingStudioServicesResource($bookingStudioService)),Response::HTTP_OK);
    }
}
