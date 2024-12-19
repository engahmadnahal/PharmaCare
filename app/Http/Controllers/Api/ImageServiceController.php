<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ErrorResponse;
use App\Http\Resources\Api\SuccessResponse;
use App\Models\ImagesService;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ImageServiceController extends Controller
{
    public function removeImage(Request $request){
        $result = [];
        $imageIds  = explode(',',$request->image_id);
        foreach($imageIds as $id){
            if($id == ""){
                continue;
            }
            array_push($result,$id);
        }
        $request->merge([
           'image_id' => $result 
        ]);
        
        $validator = Validator($request->all(),[
           'image_id.*' => 'required|numeric|exists:images_services,id',
        ]);
        if(!$validator->fails()){
            $deleted = ImagesService::whereIn('id',$request->input('image_id'))->delete();
            if(!$deleted){
                return response()->json(new ErrorResponse('ERROR_DELETE'),Response::HTTP_BAD_REQUEST);
            }
            return response()->json(new SuccessResponse('SUCCESS_DELETE',null,false));
        }else{
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }
}
