<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SuccessResponse;
use App\Http\Resources\NotificationResource;
use App\Models\NotificationFcmUser;
use Illuminate\Http\Request;

class NotificaionController extends Controller
{
    public function getNotification(){
        $data = NotificationFcmUser::where('user_id',auth()->user()->id)->orWhere('user_id',null);
        $data->update([
            'is_read' => true
        ]);
        return response(new SuccessResponse('SUCCESS_GET',NotificationResource::collection($data->get())));
    }
}
