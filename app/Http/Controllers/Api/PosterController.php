<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Http\Resources\PackagePosterResource;
use App\Http\Resources\PosterChoicePackageResource;
use App\Http\Resources\PosterPackageBookingResource;
use App\Http\Resources\PosterServicesResource;
use App\Http\Trait\CustomTrait;
use App\Models\MyCart;
use App\Models\OptionPosterprintService;
use App\Models\PackgePosterService;
use App\Models\PosterBooking;
use App\Models\PosterprintService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PosterController extends Controller
{
    use CustomTrait;

    public function getSinglePoster(PosterprintService $posterprintService)
    {
        return response()->json(new SuccessResponse('SUCCESS_GET', new PosterServicesResource($posterprintService)));
    }

    public function getPackage(PosterprintService $posterprintService, OptionPosterprintService $optionPosterprintService)
    {
        // جلب البكج التي بداخل الاحجام    
        if ($posterprintService->id != $optionPosterprintService->posterprint_service_id) {
            return response()->json(new ErrorResponse('NOT_FOUND'), Response::HTTP_BAD_REQUEST);
        }
        $data = $optionPosterprintService->package;
        return response()->json(new SuccessResponse('SUCCESS_GET', PackagePosterResource::collection($data)));
    }

    public function getChoisePackage(PosterprintService $posterprintService, OptionPosterprintService $optionPosterprintService, PackgePosterService $packgePosterService)
    {
        // جلب الاختيارات التي بداخل البكج

        if (
            $optionPosterprintService->id != $packgePosterService->option_posterprint_service_id ||
            $posterprintService->id != $optionPosterprintService->posterprint_service_id
        ) {
            return response()->json(new ErrorResponse('NOT_FOUND'), Response::HTTP_BAD_REQUEST);
        }
        return response()->json(new SuccessResponse('SUCCESS_GET', new PosterChoicePackageResource($packgePosterService)));
    }

    public function getBooking(PosterprintService $posterprintService, OptionPosterprintService $optionPosterprintService, PackgePosterService $packgePosterService)
    {
        // Check Id Services
        $packgePosterService->setAttribute('taxValue', $posterprintService->tax);
        return response()->json(new SuccessResponse('SUCCESS_GET', new PosterPackageBookingResource($packgePosterService)));
    }

    public function setBooking(Request $request)
    {

        $validator = Validator($request->all(), [
            'posterprint_service_id' => 'required|integer|exists:posterprint_services,id',
            'sized_id' => 'required|numeric|exists:option_posterprint_services,id',
            'package_id' => 'required|integer|exists:packge_poster_services,id',
            'copies_num' => 'required|integer',
            'photo_num' => 'required|integer|max:' . (PackgePosterService::find($request->package_id))?->num_item_over ?? 0,
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpg,png,jpeg,gif',
            'note' => 'nullable|string',
            'print_choices_id' => 'required|integer|exists:sub_option_posterprint_services,id',
            'frame_choices_id' => 'required|integer|exists:sub_option_posterprint_services,id',
            'print_color_choices_id' => 'required|integer|exists:sub_option_posterprint_services,id',
        ]);
        if (!$validator->fails()) {

            if (!is_null($request->file('images')) &&  count($request->file('images')) == 0)  return response()->json(new ErrorResponse('ERROR_BOOKING'), Response::HTTP_BAD_REQUEST);

            $saved = DB::transaction(function () use ($request) {

                $posterdBooking = new PosterBooking();
                $posterdBooking->posterprint_service_id = $request->input('posterprint_service_id');
                $posterdBooking->copies = $request->input('copies_num');
                $posterdBooking->photo_num = $request->input('photo_num');
                $posterdBooking->note = $request->input('note');
                $posterdBooking->packge_poster_service_id = $request->package_id;
                $posterdBooking->print_choices_id = $request->input('print_choices_id');
                $posterdBooking->frame_choices_id = $request->input('frame_choices_id');
                $posterdBooking->print_color_choices_id = $request->input('print_color_choices_id');
                $posterdBooking->user_id = auth()->user()->id;
                $saveBooking = $posterdBooking->save();


                if ($saveBooking) {
                    $cart = new MyCart();
                    $cart->object_type = PosterBooking::class;
                    $cart->object_id = $posterdBooking->id;
                    $cart->user_id = auth()->user()->id;
                    $saveCart = $cart->save();

                    $userId = auth()->user()->id;
                    // Upload Image Using Job
                    foreach ($request->file('images') as $image) {
                        $posterdBooking->images()->create([
                            'path' => $this->uploadFile($image, "posterbooking/user/{$userId}/booking/{$posterdBooking->id}"),
                        ]);
                    }
                }

                return $saveBooking && $saveCart;
            });

            if (!$saved) return response()->json(new ErrorResponse('ERROR_BOOKING'), Response::HTTP_BAD_REQUEST);

            return response()->json(new SuccessResponse('SUCCESS_SEND', null, false));
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }


    public function getEditBooking(PosterprintService $posterprintService, PosterBooking $posterBooking)
    {
        // Check Id Services
        if ($posterBooking->user_id != auth()->user()->id) {
            return response()->json(new ErrorResponse('NOT_FOUND'), Response::HTTP_BAD_REQUEST);
        }
        $data = $posterBooking->package;
        $data->setAttribute('bookingUser', $posterBooking);
        $data->setAttribute('taxValue', $posterprintService->tax);
        return response()->json(new SuccessResponse('SUCCESS_GET', new PosterPackageBookingResource($data)));
    }

    public function updateBooking(Request $request)
    {
        $posterdBooking = PosterBooking::find($request->booking_id);

        $validator = Validator($request->all(), [
            'booking_id' => 'required|numeric|exists:poster_bookings,id',
            'posterprint_service_id' => 'required|numeric|exists:posterprint_services,id',
            'copies_num' => 'required|numeric',
            'photo_num' => 'required|numeric|max:' . $posterdBooking->package?->num_item_over ?? 0,
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'note' => 'nullable|string',
            'print_choices_id' => 'required|numeric|exists:sub_option_posterprint_services,id',
            'frame_choices_id' => 'required|numeric|exists:sub_option_posterprint_services,id',
            'print_color_choices_id' => 'required|numeric|exists:sub_option_posterprint_services,id',
        ]);
        if (!$validator->fails()) {
            if (!is_null($request->file('images')) &&  count($request->file('images')) == 0)  return response()->json(new ErrorResponse('ERROR_BOOKING'), Response::HTTP_BAD_REQUEST);

            try {

                $posterdBooking->copies = $request->input('copies_num');
                $posterdBooking->photo_num = $request->input('photo_num');
                $posterdBooking->note = $request->input('note');
                $posterdBooking->print_choices_id = $request->input('print_choices_id');
                $posterdBooking->frame_choices_id = $request->input('frame_choices_id');
                $posterdBooking->print_color_choices_id = $request->input('print_color_choices_id');
                $posterdBooking->save();

                // Upload Image Using Job
                if ($request->hasFile('images')) {
                    $userId = auth()->user()->id;
                    // $posterdBooking->images()->delete();
                    foreach ($request->file('images') as $image) {
                        $posterdBooking->images()->create([
                            'path' => $this->uploadFile($image, "posterbooking/user/{$userId}/booking/{$posterdBooking->id}"),
                        ]);
                    }
                }
            } catch (Exception $e) {
                return response()->json(new ErrorResponse('ERROR_BOOKING'), Response::HTTP_BAD_REQUEST);
            }
            return response()->json(new SuccessResponse('SUCCESS_SEND', null, false));
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }
}
