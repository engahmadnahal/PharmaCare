<?php

namespace App\Http\Trait;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

trait CustomTrait
{
// Show Name Emp For user Cases
    /**
     *
     * @param file $file
     * @return string $fileName
     */
    public function uploadFile($file,$path = 'general'): string
    {
        $fileName = Str::random(4) . time() .explode('.',$file->hashName() ?? 'hash.')[0]. "." . $file->getClientOriginalExtension();
        $file->storePubliclyAs('upload/'.$path.'/', $fileName);
        return 'upload/'.$path.'/' . $fileName;
    }


    public function createNormal(Request $request,array $validate,$objectClass,$retrunObject = false){
        $object = $this->newRelatedInstance($objectClass);        
        $validator = Validator($request->all(), $validate);
        if (!$validator->fails()) {
            $data = [];
            foreach($validate as $key => $val){
                $fillable[$key] = $key;
                $data[$key] = $request->input($key);
            }
            $model = $object::create($data);
            if($retrunObject){
                return $model;
            }
            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }

    }

    public function createNormalWithFile(Request $request,array $validate,$objectClass,array $nameFiles,$path = 'general',$retrunObject = false){
        $object = $this->newRelatedInstance($objectClass);        
        $validator = Validator($request->all(), $validate);
        if (!$validator->fails()) {
            $data = [];
            foreach($validate as $key => $val){
                $data[$key] = $request->input($key);
            }
            foreach($nameFiles as $file){
                $data[$file] = $this->uploadFile($request->file($file),$path);
            }
            $model = $object::create($data);
            if($retrunObject){
                return $model;
            }
            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }

    }

    public function updateNourmal(Request $request,array $validate,$model,$retrunObject = false){
        $validator = Validator($request->all(), $validate);
        if (!$validator->fails()) {
            $data = [];
            foreach($validate as $key => $val){
                $data[$key] = $request->input($key);
            }
            $model->update($data);
            if($retrunObject){
                return $model;
            }
            return ControllersService::generateProcessResponse(true,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }

    }

    public function updateNormalWithFile(Request $request,array $validate,$model,array $nameFiles,$path = 'general',$retrunObject = false){
        $validator = Validator($request->all(), $validate);
        if (!$validator->fails()) {
            $data = [];
            
            foreach($validate as $key => $val){
                $data[$key] = $request->input($key);
            }
            foreach($nameFiles as $file){
                if($request->hasFile($file)){
                    $data[$file] = $this->uploadFile($request->file($file),$path);
                }else{
                    unset($data[$file]);
                }
            }
            $model->update($data);
            if($retrunObject){
                return $model;
            }
            return ControllersService::generateProcessResponse(true,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }

    }

    public function destroyTrait($model,$filesColumn = []){
        if(count($filesColumn) > 0){
            foreach($filesColumn as $file){
                try{
                    Storage::delete($model->get($file));
                }catch(Exception $e){
                    return response()->json([
                        'status' => false,
                        'message' =>  Messages::getMessage('ERROR'),
                    ], Response::HTTP_BAD_REQUEST);
                }
            }
        }
        $isDelete = $model->delete();
        return response()->json([
            'status' => $isDelete,
            'message' => $isDelete ? Messages::getMessage('SUCCESS') : Messages::getMessage('ERROR_DELETE'),
        ],$isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    protected function newRelatedInstance($class)
    {
        return tap(new $class, function ($instance) {});
    }
    
}
