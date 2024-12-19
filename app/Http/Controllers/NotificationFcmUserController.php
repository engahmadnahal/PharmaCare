<?php

namespace App\Http\Controllers;

use App\Events\SendNotificationEvent;
use App\Helpers\ControllersService;
use App\Helpers\UserFcmTokenController;
use App\Models\NotificationFcmUser;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationFcmUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.notifications.index',[
            'data' => NotificationFcmUser::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('cms.notifications.send-single-notification',['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(),[
            'user_id' => 'required|numeric',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'body_ar' => 'required|string',
            'body_en' => 'required|string',
        ]);

        if(!$validator->fails()){
            if($request->user_id == 0){
                $save = $this->sendAll($request);
            }else{
                $users = User::findOrFail($request->user_id);
                $save = $this->sendUser($request,$users);
            }
            $this->createNotification($request);
            return ControllersService::generateProcessResponse($save,'CREATE');
        }else{
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }


    public function createNotification($request){
        $fcm = new NotificationFcmUser();
            $fcm->title_ar = $request->title_ar;
            $fcm->title_en = $request->title_en;
            $fcm->body_ar = $request->body_ar;
            $fcm->body_en = $request->body_en;
            $fcm->user_id = $request->user_id != 0 ? $request->user_id : null;
            $saved = $fcm->save();
            return $saved;
    }

    public function sendAll($request){
        $data = [
            'title' => $request->title_ar,
            'body' => $request->body_ar,
        ];
        event(new SendNotificationEvent($data));
        return true;
    }

    public function sendUser($request,User $users){
        $tokens = $users->fcms->pluck('fcm_token')->toArray();
        $isSend = UserFcmTokenController::sendNotification($tokens,$request->body_ar,$request->title_ar,"");
        return $isSend;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NotificationFcmUser  $notificationFcmUser
     * @return \Illuminate\Http\Response
     */
    public function show(NotificationFcmUser $notificationFcmUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NotificationFcmUser  $notificationFcmUser
     * @return \Illuminate\Http\Response
     */
    public function edit(NotificationFcmUser $notificationFcmUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotificationFcmUser  $notificationFcmUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotificationFcmUser $notificationFcmUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotificationFcmUser  $notificationFcmUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationFcmUser $notificationFcmUser)
    {
        //
    }
}
