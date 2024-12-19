<?php

namespace App\Http\Controllers;

use App\Http\Trait\CustomTrait;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Ads::all();
        return view('cms.ads.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = [
            'image' => 'required|image|mimes:png,jpg',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'active' => 'required|boolean',
        ];
        return $this->createNormalWithFile($request,$validator,Ads::class,['image']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function show(Ads $ads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function edit(Ads $ads)
    {
        return view('cms.ads.edit',['data' => $ads]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ads $ads)
    {
        $validator = [
            'image' => 'nullable|image|mimes:png,jpg',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'active' => 'required|boolean',
        ];
        return $this->updateNormalWithFile($request,$validator,$ads,['image']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ads $ads)
    {
        return $this->destroyTrait($ads);
    }
}
