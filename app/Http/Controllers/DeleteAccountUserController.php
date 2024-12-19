<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Models\DeleteAccountUser;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteAccountUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = DeleteAccountUser::where('status','<>','success')->get();
        return view('cms.users.delete_account.index',[
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeleteAccountUser  $deleteAccountUser
     * @return \Illuminate\Http\Response
     */
    public function show(DeleteAccountUser $deleteAccountUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeleteAccountUser  $deleteAccountUser
     * @return \Illuminate\Http\Response
     */
    public function edit(DeleteAccountUser $deleteAccountUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeleteAccountUser  $deleteAccountUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeleteAccountUser $deleteAccountUser)
    {
        $validator = Validator($request->all(),[
            'reason' => 'nullable|string',
            'status' => 'required|string|in:reject,success'
        ]);
        if(!$validator->fails()){
            $user = User::find($deleteAccountUser->user_id);
            if($user->delete()){
                $deleteAccountUser->reason = $request->reason;
                $deleteAccountUser->status = $request->status;
                $save = $deleteAccountUser->save();
                return ControllersService::generateProcessResponse($save,'UPDATE');
            }
            return ControllersService::generateProcessResponse(false,'UPDATE');
        }else{
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeleteAccountUser  $deleteAccountUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteAccountUser $deleteAccountUser)
    {
        //
    }
}
