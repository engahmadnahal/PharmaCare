<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CountryResource;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Http\Resources\PassporteBookingResource;
use App\Http\Resources\PassportServicesObjectResource;
use App\Http\Resources\PassportTypeResource;
use App\Http\Trait\CustomTrait;
use App\Models\Country;
use App\Models\MyCart;
use App\Models\PassportBooking;
use App\Models\PassportCountry;
use App\Models\PassportOption;
use App\Models\PassportService;
use App\Models\PassportType;
use App\Models\PassportTypeCountry;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PassportController extends Controller
{
    use CustomTrait;
    public function getCountriesActiveServices()
    {
        $data = PassportCountry::has('passportTypes')->where('active', true)->get();
        return response()->json(new SuccessResponse('SUCCESS_GET', CountryResource::collection($data)), Response::HTTP_OK);
    }

    public function getServicePassport(PassportCountry $passportCountry)
    {
        $passportType = PassportType::has('passportOption')->whereHas('countries', function ($q) use ($passportCountry) {
            $q->where('passport_country_id', $passportCountry->id);
        })->get();
        return response()->json(new SuccessResponse('SUCCESS_GET', PassportTypeResource::collection($passportType)), Response::HTTP_OK);
    }

    public function getObjectServicePassport(PassportService $passportService, PassportCountry $passportCountry, PassportType $passportType)
    {

        $passportServiceIsExistsCountry = PassportType::whereId($passportType->id)->whereHas('countries', function ($q) use ($passportCountry) {
            $q->where('passport_country_id', $passportCountry->id);
        })->count();

        if ($passportServiceIsExistsCountry == 0) {
            return response()->json(new ErrorResponse('NOT_FOUND'), Response::HTTP_NOT_FOUND);
        }
        $data = $passportService->options->where('passport_type_id', $passportType->id)->where('passport_country_id', $passportCountry->id)->first();

        return response()->json(new SuccessResponse('SUCCESS_GET', new PassportServicesObjectResource($data)), Response::HTTP_OK);
    }


    public function getBooking(PassportService $passportService, PassportCountry $passportCountry, PassportType $passportType)
    {
        // Check Id Services
        $passportServiceIsExistsCountry = PassportType::whereId($passportType->id)->whereHas('countries', function ($q) use ($passportCountry) {
            $q->where('passport_country_id', $passportCountry->id);
        })->count();

        if ($passportServiceIsExistsCountry == 0) {
            return response()->json(new ErrorResponse('NOT_FOUND'), Response::HTTP_NOT_FOUND);
        }
        $data = $passportService->options->where('passport_type_id', $passportType->id)->where('passport_country_id', $passportCountry->id)->first();
        return response()->json(new SuccessResponse('SUCCESS_GET', new PassporteBookingResource($data)));
    }

    public function setBooking(Request $request)
    {

        $validator = Validator($request->all(), [
            'passport_service_id' => 'required|numeric|exists:passport_services,id',
            'country_id' => 'required|numeric|exists:passport_countries,id',
            'passport_type_id' => 'required|numeric|exists:passport_types,id',
            'quantity' => 'required|numeric',
            // 'images.*.id' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpg,png,jpeg,gif',
            // 'images.*.image' => 'required|image|mimes:jpg,png,jpeg,gif',
            'note' => 'nullable|string',
        ]);
        if (!$validator->fails()) {
            if (!is_null($request->file('images')) && count($request->file('images')) == 0)  return response()->json(new ErrorResponse('ERROR_BOOKING'), Response::HTTP_BAD_REQUEST);

            $data = PassportTypeCountry::where('passport_type_id', $request->passport_type_id)->where('passport_country_id', $request->country_id)->first();
            if ($data == null) {
                return response()->json(new ErrorResponse('NOT_FOUND'), Response::HTTP_NOT_FOUND);
            }

            $saveBook = DB::transaction(function () use ($request) {

                $passportBooking = new PassportBooking();
                $passportBooking->passport_service_id = $request->input('passport_service_id');
                $passportBooking->quantity = $request->input('quantity');
                $passportBooking->note = $request->input('note');
                $passportBooking->passport_type_id = $request->passport_type_id;
                $passportBooking->passport_country_id = $request->country_id;
                $passportBooking->user_id = auth()->user()->id;
                $saveBook = $passportBooking->save();

                if($saveBook){
                    // Set Booking in my cart
                    $cart = new MyCart();
                    $cart->object_type = PassportBooking::class;
                    $cart->object_id = $passportBooking->id;
                    $cart->user_id = auth()->user()->id;
                    $saveCart = $cart->save();
 
                    $userId = auth()->user()->id;
                    $imgs = [];
                    foreach ($request->file('images') as $image) {
                        $imgs[] = [
                            'path' => $this->uploadFile($image, "passportbooking/user/{$userId}/booking/{$passportBooking->id}"),
                            'object_type' => PassportBooking::class,
                            'object_id' => $passportBooking->id
                        ];
                    }
                    $passportBooking->images()->insert($imgs);
                }
                // return $saveBook && $saveCart;
            });

            if (!$saveBook) response()->json(new ErrorResponse('ERROR_BOOKING'), Response::HTTP_BAD_REQUEST);

            return response()->json(new SuccessResponse('SUCCESS_SEND', null, false));
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }


    public function getEditBooking(PassportService $passportService, PassportBooking $passportBooking)
    {
        // Check Id Services
        if ($passportBooking->user_id != auth()->user()->id) {
            return response()->json(new ErrorResponse('NOT_FOUND'), Response::HTTP_NOT_FOUND);
        }
        $data = $passportService->options->where('passport_type_id', $passportBooking->passport_type_id)->first();
        $data->setAttribute('bookingUser', $passportBooking);
        return response()->json(new SuccessResponse('SUCCESS_GET', new PassporteBookingResource($data)));
    }

    public function updateBooking(Request $request)
    {

        $validator = Validator($request->all(), [
            'booking_id' => 'required|numeric|exists:passport_bookings,id',
            'passport_service_id' => 'required|numeric|exists:passport_services,id',
            'country_id' => 'required|numeric|exists:passport_countries,id',
            'passport_type_id' => 'required|numeric|exists:passport_types,id',
            'quantity' => 'required|numeric',
            // 'images.*.id' => 'required|numeric',
            'images.*' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            // 'images.*.image' => 'required|image|mimes:jpg,png,jpeg,gif',
            'note' => 'nullable|string',
        ]);
        if (!$validator->fails()) {
            if (!is_null($request->file('images')) && count($request->file('images')) == 0)  return response()->json(new ErrorResponse('ERROR_BOOKING'), Response::HTTP_BAD_REQUEST);

            $data = PassportTypeCountry::where('passport_type_id', $request->passport_type_id)->where('passport_country_id', $request->country_id)->first();
            if ($data == null) {
                return response()->json(new ErrorResponse('NOT_FOUND'), Response::HTTP_NOT_FOUND);
            }
            try {
                $passportBooking = PassportBooking::find($request->booking_id);
                $passportBooking->quantity = $request->input('quantity');
                $passportBooking->note = $request->input('note');
                $passportBooking->passport_type_id = $request->passport_type_id;
                $passportBooking->passport_country_id = $request->country_id;
                $passportBooking->save();

                if ($request->hasFile('images')) {
                    // $passportBooking->images()->delete();
                    // Upload Image Using Job
                    $userId = auth()->user()->id;
                    foreach ($request->file('images') as $image) {
                        $passportBooking->images()->create([
                            'path' => $this->uploadFile($image, "passportbooking/user/{$userId}/booking/{$passportBooking->id}"),
                        ]);
                    }
                }
            } catch (Exception $e) {
                // $passportBooking->delete();
                return response()->json(new ErrorResponse('ERROR_BOOKING'), Response::HTTP_BAD_REQUEST);
            }
            return response()->json(new SuccessResponse('SUCCESS_SEND', null, false));
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }
}
