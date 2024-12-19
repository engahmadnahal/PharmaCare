<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Trait\CustomTrait;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AboutUsController extends Controller
{
    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AboutUs::get();
        return view('cms.aboutus.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.aboutus.create');
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
            $about = new AboutUs();
            $about->title_ar = $request->input('title_ar');
            $about->title_en = $request->input('title_en');
            $about->body_ar = $request->input('body_ar');
            $about->body_en = $request->input('body_en');
            $about->image = $this->uploadFile($request->file('image'));
            $about->save();

            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function show(AboutUs $aboutUs)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function edit(AboutUs $aboutUs)
    {
        return view('cms.aboutus.edit',['data' => $aboutUs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AboutUs $aboutUs)
    {

        $validator = Validator($request->all(), [
            'image' => 'nullable|image|mimes:png,jpg',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'body_ar' => 'required|string',
            'body_en' => 'required|string',
        ]);
        if (!$validator->fails()) {
            $aboutUs->title_ar = $request->input('title_ar');
            $aboutUs->title_en = $request->input('title_en');
            $aboutUs->body_ar = $request->input('body_ar');
            $aboutUs->body_en = $request->input('body_en');
            if($request->hasFile('image')){
                $aboutUs->image = $this->uploadFile($request->file('image'));
            }
            $aboutUs->save();

            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutUs $aboutUs)
    {
        $aboutUs->delete();
        return response()->json([
            'status' => true,
            'message' => Messages::getMessage('SUCCESS'),
        ],Response::HTTP_OK);
    }
}
