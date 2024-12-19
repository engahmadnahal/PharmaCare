<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Http\Resources\RateServiceCollection;
use App\Http\Resources\StudioRateCollection;
use App\Models\BookingStudioService;
use App\Models\FrameAlbumBooking;
use App\Models\FrameAlbumService;
use App\Models\OrderService;
use App\Models\PassportBooking;
use App\Models\PassportService;
use App\Models\PostcardBooking;
use App\Models\PostcardService;
use App\Models\PosterBooking;
use App\Models\PosterprintService;
use App\Models\SoftcopyBooking;
use App\Models\SoftCopyService;
use App\Models\StudioBooking;
use App\Models\StudioBranch;
use App\Models\StudioRate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RatingServiceController extends Controller
{
    public function sendRate(Request $request)
    {
        $validator = Validator($request->all(), [
            'booking_service_type' => 'required|string|in:postcard,poster,passport,frameOrAlbum,softcopy,studio',
            'booking_service_id' => 'required|integer|' . $this->getValidateBooking($request->booking_service_type),
            'master_service_id' => 'required|integer|' . $this->getValidateService($request->booking_service_type),
            'rate' => 'required|numeric|min:1|max:5',
            'comment' => 'required|string',
        ]);
        if (!$validator->fails()) {
            $isSave = $this->setRate($request);
            if (!$isSave) {
                return response()->json(new ErrorResponse('ERROR_SEND'), Response::HTTP_BAD_REQUEST);
            }
            return response()->json(new SuccessResponse('SUCCESS_SEND', null, false));
        } else {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }


    public function getSoftcopyRating(SoftCopyService $softCopyService)
    {
        $data = collect();
        $rate = OrderService::with('order.user')->whereHasMorph('object', [SoftcopyBooking::class], function ($q) use ($softCopyService) {
            $q->where('soft_copy_service_id', $softCopyService->id);
        })->where('object_type', SoftcopyBooking::class)->where('rate', '<>', null)->latest()->paginate(3);

        $data->offsetSet('data', $rate);
        $data->offsetSet('overal_rate', $softCopyService->overal_rate);

        return response()->json(new SuccessResponse('SUCCESS_GET', new RateServiceCollection($data)));
    }

    public function getStudioRating(StudioBranch $studioBranch)
    {
        $data = collect();
        $data->offsetSet('std', $studioBranch);
        $rate = StudioRate::where('studio_id',$studioBranch->id)->latest()->paginate(3);
        $data->offsetSet('data', $rate);
        return response()->json(new SuccessResponse('SUCCESS_GET', new StudioRateCollection($data)));
    }
    public function getPosterRating(PosterprintService $posterprintService)
    {
        $data = collect();
        $rate = OrderService::with('order.user')->whereHasMorph('object', [PosterBooking::class], function ($q) use ($posterprintService) {
            $q->where('posterprint_service_id', $posterprintService->id);
        })->where('object_type', PosterBooking::class)->where('rate', '<>', null)->latest()->paginate(3);

        $data->offsetSet('data', $rate);
        $data->offsetSet('overal_rate', $posterprintService->overal_rate);

        return response()->json(new SuccessResponse('SUCCESS_GET', new RateServiceCollection($data)));
    }
    public function getPostcardRating(PostcardService $postcardService)
    {
        $data = collect();
        $rate = OrderService::with('order.user')
        ->whereHasMorph('object', [PostcardBooking::class], function ($q) use ($postcardService) {
            $q->where('postcard_service_id', $postcardService->id);
        })->where('object_type', PostcardBooking::class)->where('rate', '<>', null)
        ->latest()
        ->paginate(3);

        $data->offsetSet('data', $rate);
        $data->offsetSet('overal_rate', $postcardService->overal_rate);

        return response()->json(new SuccessResponse('SUCCESS_GET', new RateServiceCollection($data)));
    }
    public function getPassportRating(PassportService $passportService)
    {
        $data = collect();
        $rate = OrderService::with('order.user')->whereHasMorph('object', [PassportBooking::class], function ($q) use ($passportService) {
            $q->where('passport_service_id', $passportService->id);
        })->where('object_type', PassportBooking::class)->where('rate', '<>', null)->latest()->paginate(3);

        $data->offsetSet('data', $rate);
        $data->offsetSet('overal_rate', $passportService->overal_rate);

        return response()->json(new SuccessResponse('SUCCESS_GET', new RateServiceCollection($data)));
    }
    public function getFrameRating(FrameAlbumService $frameAlbumService)
    {
        $data = collect();
        $rate = OrderService::with('order.user')->whereHasMorph('object', [FrameAlbumBooking::class], function ($q) use ($frameAlbumService) {
            $q->where('frame_album_service_id', $frameAlbumService->id);
        })->where('object_type', FrameAlbumBooking::class)->where('rate', '<>', null)->latest()->paginate(3);

        $data->offsetSet('data', $rate);
        $data->offsetSet('overal_rate', $frameAlbumService->overal_rate);

        return response()->json(new SuccessResponse('SUCCESS_GET', new RateServiceCollection($data)));
    }

    // ---- Functions 

    private function setRate($request)
    {
        switch ($request->booking_service_type) {
            case 'poster':
                return $this->ratePoster($request);
                break;
            case 'postcard':
                return $this->ratePostcard($request);
                break;

            case 'frameOrAlbum':
                return $this->rateFrame($request);
                break;

            case 'passport':
                return $this->ratePassport($request);
                break;
            case 'softcopy':
                return $this->rateSoftcopy($request);
                break;
            case 'studio':
                return $this->rateStudio($request);
                break;
        }
    }


    private function rateSoftcopy($request)
    {
        $service = SoftCopyService::find($request->master_service_id);
        $orderService = OrderService::where('object_type', SoftcopyBooking::class)->where('object_id', $request->booking_service_id)->first();
        if(is_null($orderService)){
            return false;
        }
        $orderService->comment = $request->input('comment');
        $orderService->rate = $request->input('rate');
        $isSave = $orderService->save();
        $rates = OrderService::where('object_type', SoftcopyBooking::class)->get();

        // overal_rate
        $this->calcOveralRate($service, $rates,$request->input('rate'));
        return $isSave;
    }

    private function rateStudio($request)
    {
        $service = BookingStudioService::find($request->master_service_id);
        $stdBooking = StudioBooking::find($request->booking_service_id);
        $orderService = OrderService::where('object_type', StudioBooking::class)->where('object_id', $request->booking_service_id)->first();
        if(is_null($orderService)){
            return false;
        }
        $orderService->comment = $request->input('comment');
        $orderService->rate = $request->input('rate');
        $isSave = $orderService->save();

        // Save Rate
        StudioRate::create([
            'studio_id' => $stdBooking->studio_id,
            'rate' => $request->input('rate'),
            'comment' => $request->input('comment'),
            'user_id' => auth()->user()->id
        ]);

        $ratesStd = StudioRate::where('studio_id',$stdBooking->studio_id)->get();
        $ratesService = OrderService::where('object_type', StudioBooking::class)->get();
        // overal_rate
        $this->calcOveralStudioRate($service, $ratesService,$ratesStd,$stdBooking->studio_id);
        return $isSave;
    }


    private function ratePoster($request)
    {
        $service = PosterprintService::find($request->master_service_id);
        $orderService = OrderService::where('object_type', PosterBooking::class)->where('object_id', $request->booking_service_id)->first();
        if(is_null($orderService)){
            return false;
        }
        $orderService->comment = $request->input('comment');
        $orderService->rate = $request->input('rate');
        $isSave = $orderService->save();
        $rates = OrderService::where('object_type', PosterBooking::class)->get();

        // overal_rate
        $this->calcOveralRate($service, $rates,$request->input('rate'));
        return $isSave;
    }

    private function ratePostcard($request)
    {
        $service = PostcardService::find($request->master_service_id);
        $orderService = OrderService::where('object_type', PostcardBooking::class)
        ->where('object_id', $request->booking_service_id)
        ->first();
        if(is_null($orderService)){
            return false;
        }
        $orderService->comment = $request->input('comment');
        $orderService->rate = $request->input('rate');
        $isSave = $orderService->save();
        $rates = OrderService::where('object_type', PostcardBooking::class)->get();

        // overal_rate
        $this->calcOveralRate($service, $rates,$request->input('rate'));
        return $isSave;
    }

    private function rateFrame($request)
    {

        $service = FrameAlbumService::find($request->master_service_id);
        $orderService = OrderService::where('object_type', FrameAlbumBooking::class)->where('object_id', $request->booking_service_id)->first();
        if(is_null($orderService)){
            return false;
        }
        $orderService->comment = $request->input('comment');
        $orderService->rate = $request->input('rate');
        $isSave = $orderService->save();
        $rates = OrderService::where('object_type', FrameAlbumBooking::class)->get();
        // overal_rate
        $this->calcOveralRate($service, $rates,$request->input('rate'));
        return $isSave;
    }

    private function ratePassport($request)
    {

        $service = PassportService::find($request->master_service_id);
        $orderService = OrderService::where('object_type', PassportBooking::class)->where('object_id', $request->booking_service_id)->first();
        if(is_null($orderService)){
            return false;
        }
        $orderService->comment = $request->input('comment');
        $orderService->rate = $request->input('rate');
        $isSave = $orderService->save();

        $rates = OrderService::where('object_type', PassportBooking::class)->get();
        // overal_rate
        $this->calcOveralRate($service, $rates,$request->input('rate'));
        return $isSave;
    }

    private function calcOveralStudioRate($service,$ratesService, $ratesStd,$stdId)
    {

        $overalRateService = $ratesService->sum('rate') / $ratesService->count();
        $service->overal_rate = $overalRateService;
        $service->save();
        // Over All Rate Studio
        $studio = StudioBranch::find($stdId);
        $overalRateStudio = $ratesStd->sum('rate') / $ratesStd->count();
        $studio->overal_rate = $overalRateStudio;
        $studio->save();
    }

    private function calcOveralRate($service, $rates,$reqRate = 0)
    {
        $overalRate = $rates->sum('rate') / $rates->count();
        $service->overal_rate = $overalRate;
        $service->save();
    }

    private function getValidateService($type)
    {
        switch ($type) {
            case 'poster':
                return 'exists:posterprint_services,id';
                break;
            case 'postcard':
                return 'exists:postcard_services,id';
                break;

            case 'frameOrAlbum':
                return 'exists:frame_album_services,id';
                break;

            case 'passport':
                return 'exists:passport_services,id';
                break;
            case 'softcopy':
                return 'exists:soft_copy_services,id';
                break;
            case 'studio':
                return 'exists:booking_studio_services,id';
                break;
        }
    }

    private function getValidateBooking($type)
    {
        switch ($type) {
            case 'poster':
                return 'exists:poster_bookings,id';
                break;
            case 'postcard':
                return 'exists:postcard_bookings,id';
                break;

            case 'frameOrAlbum':
                return 'exists:frame_album_bookings,id';
                break;

            case 'passport':
                return 'exists:passport_bookings,id';
                break;

            case 'softcopy':
                return 'exists:softcopy_bookings,id';
                break;
            case 'studio':
                return 'exists:studio_bookings,id';
                break;
        }
    }
}
