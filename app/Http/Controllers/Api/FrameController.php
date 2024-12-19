<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Http\Resources\FrameAlbumServicesResource;
use App\Http\Resources\FrameBookingsResource;
use App\Http\Resources\FrameChoiceResource;
use App\Http\Resources\FrameDetailsResource;
use App\Http\Resources\FrameResource;
use App\Http\Trait\CustomTrait;
use App\Models\FrameAlbumBooking;
use App\Models\FrameAlbumService;
use App\Models\FramesOrAlbum;
use App\Models\OptionFrameAlbumService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class FrameController extends Controller
{

    use CustomTrait;
    public function getSingleFrame(FrameAlbumService $frameAlbumService){
        return response()->json(new SuccessResponse('SUCCESS_GET',new FrameAlbumServicesResource($frameAlbumService)));
    }

    public function getChoices(FrameAlbumService $frameAlbumService,OptionFrameAlbumService $optionFrameAlbumService){
        if($frameAlbumService->id != $optionFrameAlbumService->frame_album_service_id){
            return response()->json(new ErrorResponse('NOT_FOUND'),Response::HTTP_BAD_REQUEST);
        }
        $data = FramesOrAlbum::where('option_frame_album_service_id',$optionFrameAlbumService->id)->get();
        return response()->json(new SuccessResponse('SUCCESS_GET',FrameChoiceResource::collection($data)));
    }

    public function getDeitalis(FrameAlbumService $frameAlbumService,OptionFrameAlbumService $optionFrameAlbumService,FramesOrAlbum $framesOrAlbum){
        if( 
            $optionFrameAlbumService->id != $framesOrAlbum->option_frame_album_service_id ||
            $frameAlbumService->id != $optionFrameAlbumService->frame_album_service_id
        ){
            return response()->json(new ErrorResponse('NOT_FOUND'),Response::HTTP_BAD_REQUEST);
        }
        $framesOrAlbum->setAttribute('taxValue',$frameAlbumService->is_tax ? $frameAlbumService->tax : 0);
        return response()->json(new SuccessResponse('SUCCESS_GET',new FrameDetailsResource($framesOrAlbum)));
    }

    public function getBooking(FrameAlbumService $frameAlbumService,OptionFrameAlbumService $optionFrameAlbumService,FramesOrAlbum $framesOrAlbum){
        // Check Id Services
        // if( 
        //     $optionFrameAlbumService->id != $framesOrAlbum->option_frame_album_service_id ||
        //     $frameAlbumService->id != $optionFrameAlbumService->frame_album_service_id
        // ){
        //     return response()->json(new ErrorResponse('NOT_FOUND'),Response::HTTP_BAD_REQUEST);
        // }
        // $framesOrAlbum->setAttribute('taxValue',$frameAlbumService->is_tax ? $frameAlbumService->tax : 0);
        // return response()->json(new SuccessResponse('SUCCESS_GET',new FrameBookingsResource($framesOrAlbum)));
    }

    public function setBooking(Request $request){

        $validator = Validator($request->all(),[
            'frame_album_service_id' => 'required|numeric|exists:frame_album_services,id',
            'option_id' => 'required|numeric|exists:option_frame_album_services,id',
            'choices_id' => 'required|numeric|exists:frames_or_albums,id',
            'type' => 'required|string|in:frame,album',
            'quantity' => 'required|numeric',
            // 'images.*.id' => 'required|numeric',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            // 'images.*.image' => 'required|image|mimes:jpg,png,jpeg,gif',
            'size_or_num_id' => $this->validateSize($request->input('type')),
        ]);
        if(!$validator->fails()){
            if(!is_null($request->file('images')) && count($request->file('images')) == 0)  return response()->json(new ErrorResponse('ERROR_BOOKING'),Response::HTTP_BAD_REQUEST);

            try{
            $frameAlbumBookgin = new FrameAlbumBooking();
            $frameAlbumBookgin->frame_album_service_id = $request->frame_album_service_id;
            $frameAlbumBookgin->frames_or_album_id = $request->choices_id;
            $frameAlbumBookgin->quantity = $request->input('quantity');
            $frameAlbumBookgin->type = $request->input('type');
            if($request->input('type') == 'frame'){
                $frameAlbumBookgin->frames_size_id = $request->input('size_or_num_id');
            }else{

                $frameAlbumBookgin->album_size_id = $request->input('size_or_num_id');
            }
            $frameAlbumBookgin->user_id = auth()->user()->id;
            $frameAlbumBookgin->save();

            // Set Booking in my cart
            $frameAlbumBookgin->cart()->create([
                'user_id' => auth()->user()->id
            ]);
            // Upload Image Using Job
            if($request->hasFile('images')){
                $userId = auth()->user()->id;
                foreach($request->file('images') as $image){
                    $frameAlbumBookgin->images()->create([
                        'path' => $this->uploadFile($image,"framebooking/user/{$userId}/booking/{$frameAlbumBookgin->id}"),
                    ]);
                }
            }
        }catch(Exception $e){
            $frameAlbumBookgin->delete();
            return response()->json(new ErrorResponse('ERROR_BOOKING'),Response::HTTP_BAD_REQUEST);
        }

            return response()->json(new SuccessResponse('SUCCESS_SEND',null,false));
        }else{
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }


    public function getEditBooking(FrameAlbumService $frameAlbumService,FrameAlbumBooking $frameAlbumBookgin){
        // Check Id Services
        if( 
            $frameAlbumBookgin->user_id != auth()->user()->id
        ){
            return response()->json(new ErrorResponse('NOT_FOUND'),Response::HTTP_BAD_REQUEST);
        }
        $data = $frameAlbumBookgin->frameOrAlbum;
        $data->setAttribute('bookingUser',$frameAlbumBookgin);
        $data->setAttribute('taxValue',$frameAlbumService->tax);
        return response()->json(new SuccessResponse('SUCCESS_GET',new FrameBookingsResource($data)));
    }

    public function updateBooking(Request $request){

        $validator = Validator($request->all(),[
            'booking_id' => 'required|numeric|exists:frame_album_bookings,id',
            'frame_album_service_id' => 'required|numeric|exists:frame_album_services,id',
            // 'option_id' => 'required|numeric|exists:option_frame_album_services,id',
            // 'choices_id' => 'required|numeric|exists:frames_or_albums,id',
            'type' => 'required|string|in:frame,album',
            'quantity' => 'required|numeric',
            // 'images.*.id' => 'required|numeric',
            'images.*' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            // 'images.*.image' => 'required|image|mimes:jpg,png,jpeg,gif',
            'size_or_num_id' => $this->validateSize($request->input('type')),
        ]);
        if(!$validator->fails()){
            if(!is_null($request->file('images')) && count($request->file('images')) == 0)  return response()->json(new ErrorResponse('ERROR_BOOKING'),Response::HTTP_BAD_REQUEST);

            try{
            $frameAlbumBookgin = FrameAlbumBooking::find($request->booking_id);
            $frameAlbumBookgin->quantity = $request->input('quantity');
            $frameAlbumBookgin->type = $request->input('type');
            if($request->input('type') == 'frame'){
                $frameAlbumBookgin->frames_size_id = $request->input('size_or_num_id');
            }else{

                $frameAlbumBookgin->album_size_id = $request->input('size_or_num_id');
            }
            $frameAlbumBookgin->save();

            // Upload Image Using Job
            if($request->hasFile('images')){
                // $frameAlbumBookgin->images()->delete();
                $userId = auth()->user()->id;
                foreach($request->file('images') as $image){
                    $frameAlbumBookgin->images()->create([
                        'path' => $this->uploadFile($image,"framebooking/user/{$userId}/booking/{$frameAlbumBookgin->id}"),
                        // 'path' => $this->uploadFile($image,'framebooking/user/'.auth()->user()->id),
                    ]);
                }
            }
        }catch(Exception $e){
            return response()->json(new ErrorResponse('ERROR_BOOKING'),Response::HTTP_BAD_REQUEST);
        }

            return response()->json(new SuccessResponse('SUCCESS_SEND',null,false));
        }else{
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    private function validateSize($type){
        if($type == 'frame'){
            return 'required|numeric|exists:frames_sizes,id';
        }else{
            return 'required|numeric|exists:album_sizes,id';
        }
    }
}
