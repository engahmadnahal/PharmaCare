<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.users.index',[
            'data' => User::with('userAddress','country')->get()
        ]);
    }

    public function blockUser(Request $request){
        $validator = Validator($request->all(),[
            'user_id' => 'required|integer|exists:users,id'
        ]);
        if(!$validator->fails()){
            $user = User::find($request->user_id);
            $user->status = 'blocked';
            $saved = $user->save();
            return ControllersService::generateProcessResponse($saved,'UPDATE');
        }else{
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $orders = Order::with(['orderStatus','studioSendOrder','services','user'])->where('user_id',$user->id)->orderBy('created_at','desc')->get();
        $services = OrderService::with('order')->whereIn('order_id',$orders->pluck('id'))->get();
        return view('cms.users.show',[
            'data' => $user,
            'orders' => $orders,
            'services' => $services
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
