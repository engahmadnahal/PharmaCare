<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;
use App\Http\Resources\Api\CountryResource;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Http\Resources\AppContentResource;
use App\Http\Resources\AppFaqsResource;
use App\Models\AboutUs;
use App\Models\City;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\Faqs;
use App\Models\Privecy;
use App\Models\TermUser;
use Illuminate\Http\Request;
use Nette\Utils\Arrays;
use Symfony\Component\HttpFoundation\Response;

class AppController extends Controller
{
    public function contactUs(Request $request){
        $validator = Validator($request->all(), [
            'name' => 'required|string',
            'mobile' => 'required|string',
            'message' => 'required|string|max:300',
        ]);
        if (!$validator->fails()) {
            $contactUs = new ContactUs;
            $contactUs->name = $request->input('name');
            $contactUs->mobile = $request->input('mobile');
            $contactUs->message = $request->input('message');
            $contactUs->user_id = auth()->user()->id;
            $contactUs->save();
            return response(new SuccessResponse('SUCCESS_CONTACT_SEND',null,false),Response::HTTP_OK);
        } else {
            return response(new ErrorResponse('ERROR_SEND',$validator->getMessageBag()->first()),Response::HTTP_BAD_REQUEST);
        }
    }

    public function aboutUs(){
        $data = AboutUs::first();
        if($data == null){
            return response()->json(new ErrorResponse('NO_RESULTS'),Response::HTTP_BAD_REQUEST);
        }
        return response()->json(new SuccessResponse('SUCCESS_GET', new AppContentResource($data)),Response::HTTP_OK);
    }

    public function faqs(){
        $data = Faqs::all();
        if($data == null){
            return response()->json(new ErrorResponse('NO_RESULTS'),Response::HTTP_BAD_REQUEST);
        }
        return response()->json(new SuccessResponse('SUCCESS_GET',AppFaqsResource::collection($data)),Response::HTTP_OK);
    }

    public function privacy(){
        $data = Privecy::first();
        if($data == null){
            return response()->json(new ErrorResponse('NO_RESULTS'),Response::HTTP_BAD_REQUEST);
        }
        return response()->json(new SuccessResponse('SUCCESS_GET',new AppContentResource($data)),Response::HTTP_OK);
    }

    public function terms(){
        $data = TermUser::first();
        if($data == null){
            return response()->json(new ErrorResponse('NO_RESULTS'),Response::HTTP_BAD_REQUEST);
        }
        return response()->json(new SuccessResponse('SUCCESS_GET', new AppContentResource($data)),Response::HTTP_OK);
    }

    public function cities(){
        $data = City::where('active',true)->get();
        return response()->json(new SuccessResponse('SUCCESS_GET',CityResource::collection($data)),Response::HTTP_OK);
    }

    public function countries(){
        $data = Country::where('active',true)->get();
        return response()->json(new SuccessResponse('SUCCESS_GET',CountryResource::collection($data)),Response::HTTP_OK);
    }

    public function getCityByCountry(Country $country){
        $city = $country->cities;
        return response()->json(new SuccessResponse('SUCCESS_GET',CityResource::collection($city)),Response::HTTP_OK);
    }



}
