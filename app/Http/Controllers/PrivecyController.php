<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Requests\AboutPrivecyTermUserReqest;
use App\Http\Resources\PrivecyResource;
use App\Http\Trait\CustomTrait;
use App\Models\Privecy;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrivecyController extends Controller
{
    use CustomTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Privecy::get();
        return view('cms.privecy.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.privecy.create');
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
            $privecy = new Privecy();
            $privecy->title_ar = $request->input('title_ar');
            $privecy->title_en = $request->input('title_en');
            $privecy->body_ar = $request->input('body_ar');
            $privecy->body_en = $request->input('body_en');
            $privecy->image = $this->uploadFile($request->file('image'));
            $privecy->save();

            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TermUser  $privecy
     * @return \Illuminate\Http\Response
     */
    public function show(Privecy $privecy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TermUser  $privecy
     * @return \Illuminate\Http\Response
     */
    public function edit(Privecy $privecy)
    {
        return view('cms.privecy.edit',['data' => $privecy]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TermUser  $privecy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Privecy $privecy)
    {
        $validator = Validator($request->all(), [
            'image' => 'nullable|image|mimes:png,jpg',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'body_ar' => 'required|string',
            'body_en' => 'required|string',
        ]);
        if (!$validator->fails()) {
            $privecy->title_ar = $request->input('title_ar');
            $privecy->title_en = $request->input('title_en');
            $privecy->body_ar = $request->input('body_ar');
            $privecy->body_en = $request->input('body_en');
            if($request->hasFile('image')){
                $privecy->image = $this->uploadFile($request->file('image'));
            }
            $privecy->save();

            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TermUser  $privecy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Privecy $privecy)
    {
        $privecy->delete();
        return response()->json([
            'status' => true,
            'message' => Messages::getMessage('SUCCESS'),
        ],Response::HTTP_OK);
    }
    
}
