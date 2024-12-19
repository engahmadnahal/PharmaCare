<?php

namespace App\Http\Controllers;

use App\Helpers\Messages;
use App\Models\StudioBranch;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestAcceptStudioController extends Controller
{
    public function index(){
        $data = StudioBranch::where('isAcceptable','wait')->get();
        return view('cms.accept-studio.index',['data' => $data]);
    }


    public function show(){

    }

    public function accept($id){
        $branch = StudioBranch::find($id);
        $branch->isAcceptable = 'accept';
        $branch->save();
        return response()->json(['message' => Messages::getMessage('SUCCESS')], Response::HTTP_OK);
    }

    public function inAccept($id){
        $branch = StudioBranch::find($id);
        $branch->isAcceptable = 'inAccept';
        $branch->save();
        return response()->json(['message' => Messages::getMessage('SUCCESS')], Response::HTTP_OK);
    }

}
