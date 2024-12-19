<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdsResource;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Http\Resources\BookingStudioServicesResource;
use App\Http\Resources\FrameAlbumServicesResource;
use App\Http\Resources\OptionFrameAlbumServicesResource;
use App\Http\Resources\OptionPostcardServicesResource;
use App\Http\Resources\OptionPosterServicesResource;
use App\Http\Resources\PassportServicesResource;
use App\Http\Resources\PassportTypeResource;
use App\Http\Resources\PostcardServicesResource;
use App\Http\Resources\PosterServicesResource;
use App\Http\Resources\ServicesResource;
use App\Http\Resources\SoftcopyServicesResource;
use App\Models\Ads;
use App\Models\BookingStudioService;
use App\Models\DeleteAccountUser;
use App\Models\FrameAlbumService;
use App\Models\NotificationFcmUser;
use App\Models\OptionFrameAlbumService;
use App\Models\OptionPostcardService;
use App\Models\OptionPosterprintService;
use App\Models\PassportService;
use App\Models\PassportType;
use App\Models\PostcardService;
use App\Models\PosterprintService;
use App\Models\SoftCopyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Passport;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;
use Symfony\Component\HttpFoundation\Response;

class ServicesController extends Controller
{

    public function allServices()
    {
        $data = collect();
        $passport = PassportService::where('active', true)->get();
        $postcard = PostcardService::where('active', true)->get();
        $poster = PosterprintService::where('active', true)->get();
        $frameAlbum = FrameAlbumService::where('active', true)->get();
        $softcopy = SoftCopyService::where('active', true)->get();
        $bookingStudio = BookingStudioService::where('active', true)->get();
        $ads = Ads::where('active',true)->get();

        foreach ($passport as $d) {
            $data->add($d);
        }

        foreach ($postcard as $d) {
            $data->add($d);
        }

        foreach ($poster as $d) {
            $data->add($d);
        }


        foreach ($frameAlbum as $d) {
            $data->add($d);
        }

        foreach ($softcopy as $d) {
            $data->add($d);
        }

        foreach ($bookingStudio as $d) {
            $data->add($d);
        }

        $notification = NotificationFcmUser::where('user_id',auth()->user()->id)->where('is_read',false)->count();
        return response()->json(new SuccessResponse('SUCCESS_GET', 
        [
            'user_setting' => [
                'delete_account' => DeleteAccountUser::where('user_id',auth()->user()->id)->where('status','wait')->exists(),
                'lat' => (string) auth()->user()->defaultAddress?->latitude ?? "",
                'long' => (string) auth()->user()->defaultAddress?->longitude ?? ""
            ],
            'notifications' => [
                'is_notification' => $notification > 0,
                'count' => $notification
            ],
            'ads' => $ads->pluck('image')->map(function($ad){
                return Storage::url($ad);
            }),
            'services' => ServicesResource::collection($data)
        ]), Response::HTTP_OK);
    }


    public function getObjectService($type, $id)
    {
        if ($type == null && $id == null) {
            return response()->json(new ErrorResponse('ERROR'), Response::HTTP_BAD_REQUEST);
        }
        switch ($type) {
            // case 'passport':
            //     return $this->passportService(true,$id);
            //     break;
            case 'frameAlbum':

                return $this->frameAlbumService(true,$id);

                break;
            case 'softcopy':
                return $this->softCopyService(true,$id);

                break;
            // case 'bookingstudio':
            //     return $this->bookingStudioService(true,$id);

            //     break;
            case 'posterprinting':
                return $this->posterService(true,$id);

                break;
            case 'postcard':
                return $this->postcardService(true,$id);
                break;
        }

        return response()->json(new ErrorResponse('NOT_FOUND'),Response::HTTP_BAD_REQUEST);
    }

    public function getObjectOptionService($type, $id)
    {
        if ($type == null && $id == null) {
            return response()->json(new ErrorResponse('ERROR'), Response::HTTP_BAD_REQUEST);
        }
        switch ($type) {
           
            case 'frameAlbum':
                return $this->getOptionFrameAlbum($id);
                break;
            
            case 'posterprinting':
                return $this->getOptionPoster($id);
                break;
            case 'postcard':
                return $this->getOptionPostcard($id);
                break;
        }

        return response()->json(new ErrorResponse('The Type Selected is invalid !'),Response::HTTP_BAD_REQUEST);
    }



    

    public function postcardService($isSingle = false, $id = null)
    {
        if ($isSingle && !is_null($id)) {
            $data = PostcardService::find($id);
            return response()->json(new SuccessResponse('SUCCESS_GET',new PostcardServicesResource($data)),Response::HTTP_OK);
        }
    }

    public function posterService($isSingle = false, $id = null)
    {
        if ($isSingle && !is_null($id)) {
            $data = PosterprintService::find($id);
            return response()->json(new SuccessResponse('SUCCESS_GET',new PosterServicesResource($data)),Response::HTTP_OK);
        }
    }

    public function frameAlbumService($isSingle = false, $id = null)
    {
        if ($isSingle && !is_null($id)) {
            $data = FrameAlbumService::find($id);
            return response()->json(new SuccessResponse('SUCCESS_GET',new FrameAlbumServicesResource($data)),Response::HTTP_OK);
        }
    }

    public function softCopyService($isSingle = false, $id = null)
    {
        if ($isSingle && !is_null($id)) {
            $data = SoftCopyService::find($id);
            return response()->json(new SuccessResponse('SUCCESS_GET',new SoftcopyServicesResource($data)),Response::HTTP_OK);
        }
    }

    



    public function getOptionPoster($id){
        if (!is_null($id)) {
            $data = OptionPosterprintService::where('posterprint_service_id',$id)->get();
            return response()->json(new SuccessResponse('SUCCESS_GET',OptionPosterServicesResource::collection(($data))),Response::HTTP_OK);
        }
    }

    public function getOptionPostcard($id){
        if (!is_null($id)) {
            $data = OptionPostcardService::where('postcard_service_id',$id)->get();
            return response()->json(new SuccessResponse('SUCCESS_GET',OptionPostcardServicesResource::collection($data)),Response::HTTP_OK);
        }
    }

    public function getOptionFrameAlbum($id){
        if (!is_null($id)) {
            $data = OptionFrameAlbumService::where('frame_album_service_id',$id)->get();
            return response()->json(new SuccessResponse('SUCCESS_GET',OptionFrameAlbumServicesResource::collection($data)),Response::HTTP_OK);
        }
    }
}
