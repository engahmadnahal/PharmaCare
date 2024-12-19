<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Http\Resources\UserAddressResource;
use App\Models\DeleteAccountUser;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    public function getByDefualtAffress(){
        $defualtAddreess = UserAddress::where('user_id',auth()->user()->id)->where('isDefault',true)->first();
        $userAddress = auth()->user()->userAddress->where('country_id',$defualtAddreess->country_id);
        return response(new SuccessResponse('SUCCESS_GET',UserAddressResource::collection($userAddress)),Response::HTTP_OK);
    }



    public function getAllAddress(){
        // $userAddress = UserAddress::where('user_id',auth);
        $userAddress = auth()->user()->userAddress;
        return response(new SuccessResponse('SUCCESS_GET',UserAddressResource::collection($userAddress)),Response::HTTP_OK);
    }
    
    public function setAddress(Request $request){
        $validator = Validator($request->all(), [
            'title' => 'required|string',
            'details' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'isDefault' => 'required|boolean',
            'city_id' => 'required|numeric|exists:cities,id',
            'country_id' => 'required|numeric|exists:countries,id',
        ]);
        if (!$validator->fails()) {
            $userAddressExists = UserAddress::where('user_id',auth()->user()->id)->where('isDefault',true)->exists();
            if($userAddressExists && $request->isDefault){
                UserAddress::where('user_id',auth()->user()->id)->update([
                    'isDefault' => false
                ]);
            }
            $userAddress = new UserAddress();
            $userAddress->user_id = auth()->user()->id;
            $userAddress->title = $request->input('title');
            $userAddress->latitude = $request->input('latitude');
            $userAddress->longitude = $request->input('longitude');
            $userAddress->details = $request->input('details');
            $userAddress->isDefault = $request->input('isDefault');
            $userAddress->city_id = $request->input('city_id');
            $userAddress->country_id = $request->input('country_id');
            $userAddress->save();

            return response(new SuccessResponse('SUCCESS_SEND',new UserAddressResource($userAddress)),Response::HTTP_OK);
        } else {
            return response(new ErrorResponse('ERROR_SEND',$validator->getMessageBag()->first()),Response::HTTP_BAD_REQUEST);
        }


        
    }

    public function editAddress(Request $request ,UserAddress $userAddress){
        $validator = Validator($request->all(), [
            'title' => 'required|string',
            'details' => 'required|string',
            'isDefault' => 'required|boolean',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'city_id' => 'required|numeric|exists:cities,id',
            'country_id' => 'required|numeric|exists:countries,id',
        ]);
        if (!$validator->fails()) {
            if($request->isDefault){
                UserAddress::where('user_id',auth()->user()->id)->where('id','<>',$userAddress->id)->update([
                    'isDefault' => false
                ]);
            }else{
                $countDef = UserAddress::where('user_id',auth()->user()->id)->where('isDefault',true)->count();
                if($countDef == 1){
                    return response()->json(new ErrorResponse('SET_DEFUALT_ADDRESS'),Response::HTTP_BAD_REQUEST);

                }
            }

            $userAddress->user_id = auth()->user()->id;
            $userAddress->title = $request->input('title');
            $userAddress->latitude = $request->input('latitude');
            $userAddress->longitude = $request->input('longitude');
            $userAddress->details = $request->input('details');
            $userAddress->isDefault = $request->input('isDefault');
            $userAddress->city_id = $request->input('city_id');
            $userAddress->country_id = $request->input('country_id');
            $userAddress->save();

            return response(new SuccessResponse('SUCCESS_EDIT',new UserAddressResource($userAddress)),Response::HTTP_OK);
        } else {
            return response(new ErrorResponse('ERROR_SEND',$validator->getMessageBag()->first()),Response::HTTP_BAD_REQUEST);
        }

    }

    public function deleteAddress(UserAddress $userAddress){
        if($userAddress->isDefault){
            return response()->json(new ErrorResponse('SET_DEFUALT_ADDRESS'),Response::HTTP_BAD_REQUEST);
        }
        $isDelete = $userAddress->delete();
        return response(new SuccessResponse($isDelete ? 'SUCCESS_DELETE' : 'ERROR_DELETE'),$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function isNotify(){
        $user = auth()->user();
        $user->isNotify = !$user->isNotify;
        $user->save();

        $data = [
            'isNotify' => $user->isNotify
        ];
        return response(new SuccessResponse('SUCCESS',$data),Response::HTTP_OK);
    }

    public function deleteAccount(){
        if(DeleteAccountUser::where('user_id',auth()->user()->id)->where('status','wait')->exists()){
            return response()->json(new ErrorResponse('ALREAY_DELETE_REQUEST'),Response::HTTP_BAD_REQUEST);
        }
        $deleteAccountUser = new DeleteAccountUser();
        $deleteAccountUser->user_id = auth()->user()->id;
        $saved = $deleteAccountUser->save();
        return response()->json(
            $saved ? new SuccessResponse('DELETED_AFTER_24_H',null,false) : new ErrorResponse('ERROR'),
            $saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
