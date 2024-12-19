<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Requests\AboutPrivecyTermUserReqest;
use App\Http\Resources\TermUserResource;
use App\Http\Trait\CustomTrait;
use App\Models\TermUser;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TermUserController extends Controller
{
    use CustomTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TermUser::get();
        return view('cms.term.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.term.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'image' => 'nullable|image|mimes:png,jpg',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'body_ar' => 'required|string',
            'body_en' => 'required|string',
        ]);
        if (!$validator->fails()) {
            $termUser = new TermUser();
            $termUser->title_ar = $request->input('title_ar');
            $termUser->title_en = $request->input('title_en');
            $termUser->body_ar = $request->input('body_ar');
            $termUser->body_en = $request->input('body_en');
            $termUser->image = $this->uploadFile($request->file('image'));
            $termUser->save();

            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TermUser  $termUser
     * @return \Illuminate\Http\Response
     */
    public function show(TermUser $termUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TermUser  $termUser
     * @return \Illuminate\Http\Response
     */
    public function edit(TermUser $termUser)
    {
        return view('cms.term.edit',['data' => $termUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TermUser  $termUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TermUser $termUser)
    {
        $validator = Validator($request->all(), [
            'image' => 'nullable|image|mimes:png,jpg',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'body_ar' => 'required|string',
            'body_en' => 'required|string',
        ]);
        if (!$validator->fails()) {
            $termUser->title_ar = $request->input('title_ar');
            $termUser->title_en = $request->input('title_en');
            $termUser->body_ar = $request->input('body_ar');
            $termUser->body_en = $request->input('body_en');
            if($request->hasFile('image')){
                $termUser->image = $this->uploadFile($request->file('image'));
            }
            $termUser->save();

            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TermUser  $termUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermUser $termUser)
    {
        $termUser->delete();
        return response()->json([
            'status' => true,
            'message' => Messages::getMessage('SUCCESS'),
        ],Response::HTTP_OK);
    }
}
