<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Models\ContactUs;
use Dotenv\Validator;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {
        $data = ContactUs::with('user')->when($status,function($q) use($status){
            $q->where('status',$status);
        })->get();
        return view('cms.contact-us.index',[
            'data' => $data,
            'status' => $status
        ]);
    }



    public function changeStatus(Request $request){
        $validator = Validator($request->all(),[
            'contact_us_id' => 'required|integer|exists:contact_us,id',
            'status' => 'required|string|in:high,medium,low,responsed,wait'
        ]);
        if(!$validator->fails()){
            $contactUs = ContactUs::find($request->contact_us_id);
            $contactUs->status = $request->status;
            $saved = $contactUs->save();
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
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUs $contactUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUs $contactUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactUs $contactUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contactUs)
    {
        //
    }
}
