<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Models\Faqs;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Faqs::all();
        return view('cms.faqs.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.faqs.create');
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
            'qs_ar' => 'required|string',
            'qs_en' => 'required|string',
            'answer_ar' => 'required|string',
            'answer_en' => 'required|string',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
        ]);
        if (!$validator->fails()) {
            $faqs = new Faqs();
            $faqs->title_ar = $request->input('title_ar');
            $faqs->title_en = $request->input('title_en');
            $faqs->qs_ar = $request->input('qs_ar');
            $faqs->qs_en = $request->input('qs_en');
            $faqs->answer_ar = $request->input('answer_ar');
            $faqs->answer_en = $request->input('answer_en');
            $faqs->save();

            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function show(Faqs $faqs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function edit(Faqs $faqs)
    {
        return view('cms.faqs.edit',['data' => $faqs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faqs $faqs)
    {
        $validator = Validator($request->all(), [
            'qs_ar' => 'required|string',
            'qs_en' => 'required|string',
            'answer_ar' => 'required|string',
            'answer_en' => 'required|string',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
        ]);
        if (!$validator->fails()) {
            $faqs->title_ar = $request->input('title_ar');
            $faqs->title_en = $request->input('title_en');
            $faqs->qs_ar = $request->input('qs_ar');
            $faqs->qs_en = $request->input('qs_en');
            $faqs->answer_ar = $request->input('answer_ar');
            $faqs->answer_en = $request->input('answer_en');
            $faqs->save();

            return ControllersService::generateProcessResponse(true,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faqs  $faqs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faqs $faqs)
    {
        $faqs->delete();
        return response()->json([
            'status' => true,
            'message' => Messages::getMessage('SUCCESS'),
        ],Response::HTTP_OK);
    }
}
