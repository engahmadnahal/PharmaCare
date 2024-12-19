<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Http\Resources\PostcardPackageBookingResource;
use App\Http\Resources\PostcardPackageResource;
use App\Http\Resources\PostcardServicesResource;
use App\Http\Trait\CustomTrait;
use App\Models\MyCart;
use App\Models\OptionPostcardService;
use App\Models\PostcardBooking;
use App\Models\PostcardService;
use App\Models\SubOptionPostcardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PostcardController extends Controller
{

    use CustomTrait;
    public function getSinglePostcard(PostcardService $postcardService)
    {
        return response()->json(new SuccessResponse('SUCCESS_GET', new PostcardServicesResource($postcardService)), Response::HTTP_OK);
    }

    public function getPackage(PostcardService $postcardService, OptionPostcardService $optionPostcardService)
    {
        if ($postcardService->id != $optionPostcardService->postcard_service_id) {
            return response()->json(new ErrorResponse('NOT_FOUND'), Response::HTTP_BAD_REQUEST);
        }
        $data = $optionPostcardService->subOptions;
        return response()->json(new SuccessResponse('SUCCESS_GET', PostcardPackageResource::collection($data)), Response::HTTP_OK);
    }


    public function getBooking(PostcardService $postcardService, OptionPostcardService $optionPostcardService, SubOptionPostcardService $subOptionPostcardService)
    {
        // Check Id Services
        $data = ($postcardService->options->where('id', $optionPostcardService->id)->first())
            ->subOptions->where('id', $subOptionPostcardService->id)->first();
        $data->setAttribute('taxValue', $postcardService->tax);
        return response()->json(new SuccessResponse('SUCCESS_GET', new PostcardPackageBookingResource($data)));
    }

    public function setBooking(Request $request)
    {


        $validator = Validator($request->all(), [
            'postcard_service_id' => 'required|numeric|exists:postcard_services,id',
            'sized_id' => 'required|integer|exists:option_postcard_services,id',
            'package_id' => 'required|integer|exists:sub_option_postcard_services,id',
            'copies_num' => 'required|integer',
            'photo_num' => 'required|integer|max:' . (SubOptionPostcardService::find($request->package_id))?->num_item_over ?? 0,
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpg,png,jpeg,gif',
            'note' => 'nullable|string',
        ]);
        if (!$validator->fails()) {

            if (!is_null($request->file('images')) &&  count($request->file('images')) == 0)  return response()->json(new ErrorResponse('ERROR_BOOKING'), Response::HTTP_BAD_REQUEST);

            $isSave =  DB::transaction(function () use ($request) {
                $postcardBooking = new PostcardBooking();
                $postcardBooking->postcard_service_id = $request->input('postcard_service_id');
                $postcardBooking->copies = $request->input('copies_num');
                $postcardBooking->photo_num = $request->input('photo_num');
                $postcardBooking->note = $request->input('note');
                $postcardBooking->sub_option_postcard_service_id = $request->package_id;
                $postcardBooking->user_id = auth()->user()->id;
                $isSave = $postcardBooking->save();

                if ($isSave) {
                    $cart = new MyCart();
                    $cart->object_type = PostcardBooking::class;
                    $cart->object_id = $postcardBooking->id;
                    $cart->user_id = auth()->user()->id;
                    $saveCart = $cart->save();


                    $userId = auth()->user()->id;
                    $imgs = [];
                    // Upload Image Using Job
                    foreach ($request->file('images') as $image) {
                        $imgs[] = [
                            'path' => $this->uploadFile($image, "postcardbooking/user/{$userId}/booking/{$postcardBooking->id}"),
                            'object_type' => PostcardBooking::class,
                            'object_id' => $postcardBooking->id
                        ];
                    }
                    $postcardBooking->images()->insert($imgs);
                }
                return $isSave && $saveCart;
            });

            if (!$isSave) {
                return response()->json(new ErrorResponse('ERROR_BOOKING'), Response::HTTP_BAD_REQUEST);
            }
            return response()->json(new SuccessResponse('SUCCESS_SEND', null, false));
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }



    public function getEditBooking(PostcardService $postcardService, PostcardBooking $postcardBooking)
    {
        // Check Id Services
        if ($postcardBooking->user_id != auth()->user()->id) {
            return response()->json(new ErrorResponse('NOT_FOUND'), Response::HTTP_BAD_REQUEST);
        }
        $data = $postcardBooking->subOptions;
        $data->setAttribute('bookingUser', $postcardBooking);
        $data->setAttribute('taxValue', $postcardService->tax);
        return response()->json(new SuccessResponse('SUCCESS_GET', new PostcardPackageBookingResource($data)));
    }

    public function updateBooking(Request $request)
    {
        $validator = Validator($request->all(), [
            'booking_id' => 'required|integer|exists:postcard_bookings,id',
            'postcard_service_id' => 'required|integer|exists:postcard_services,id',
            'copies_num' => 'required|integer',
            'photo_num' => 'required|integer|max:' . (PostcardBooking::find($request->booking_id))?->subOptions?->num_item_over ?? 0,
            'images.*' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'note' => 'nullable|string',
        ]);
        if (!$validator->fails()) {
            if (!is_null($request->file('images')) && count($request->file('images')) == 0)  return response()->json(new ErrorResponse('ERROR_BOOKING'), Response::HTTP_BAD_REQUEST);

            $saved = DB::transaction(function () use ($request) {

                $postcardBooking = PostcardBooking::find($request->booking_id);
                $postcardBooking->copies = $request->input('copies_num');
                $postcardBooking->photo_num = $request->input('photo_num');
                $postcardBooking->note = $request->input('note');
                $saved = $postcardBooking->save();

                // Upload Image Using Job
                if ($request->hasFile('images')) {
                    $userId = auth()->user()->id;
                    foreach ($request->file('images') as $image) {
                        $postcardBooking->images()->create([
                            'path' => $this->uploadFile($image, "postcardbooking/user/{$userId}/booking/{$postcardBooking->id}"),
                        ]);
                    }
                }

                return $saved;
            });

            if (!$saved) {
                return response()->json(new ErrorResponse('ERROR_BOOKING'), Response::HTTP_BAD_REQUEST);
            }
            return response()->json(new SuccessResponse('SUCCESS_SEND', null, false));
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }
}
