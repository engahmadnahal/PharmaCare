<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Trait\CustomTrait;
use App\Models\City;
use App\Models\Currency;
use App\Models\Region;
use App\Models\ServiceStudio;
use App\Models\StudioBranch;
use App\Models\StudioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class StudioBranchController extends Controller
{
    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth('studio')->check()){
            $data = StudioBranch::where('studio_id',auth('studio')->user()->id)->get();
        }else{
            $data = StudioBranch::all();
        }
        return view('cms.studiosBranch.index',['data' => $data]);
    }

    public function blockStudio(Request $request){
        $validator = Validator($request->all(),[
            'branch_id' => 'required|integer|exists:studio_branches,id',
            'reson_block' =>  'required|string',
            'block' => 'required|boolean',
        ]);
        if(!$validator->fails()){
            $studioBranch = StudioBranch::find($request->branch_id);
            $studioBranch->block = $request->block;
            $studioBranch->reson_block = $request->reson_block;
            $saved = $studioBranch->save();
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

        $roles = Role::where('guard_name','studiobranch')->get();
        $region = Region::where('active',true)->get();
        $cities = City::where('active',true)->get();
        return view('cms.studiosBranch.create',['cities' => $cities,'roles' =>$roles,'region' => $region]);
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
            'type' => 'required|string|in:branch,main',
            'name' => 'required|string',
            'email' => 'required|email|unique:studio_branches,email',
            'mobile' => 'required|string|unique:studio_branches,mobile',
            'address' => 'required|string',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'avater' => 'nullable|image|mimes:png,jpg',
            'role_id' => 'required|integer|exists:roles,id',
            'city_id' => 'required|integer|exists:cities,id',
            'region_id' => 'required|integer|exists:regions,id',
            'password' => 'required|string|min:6|max:12',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'active' => 'required|boolean',
            'is_lawful_service' => 'required|boolean',
            'slider_images_1' => 'required|image|mimes:png,jpg',
            'slider_images_2' => 'required|image|mimes:png,jpg',
            'slider_images_3' => 'required|image|mimes:png,jpg',
            'slider_images_4' => 'required|image|mimes:png,jpg',
        ]);
        if (!$validator->fails()) {
            $city = City::find($request->city_id);
            $slid1 = $this->uploadFile($request->file('slider_images_1'),'softcopy');
            $slid2 = $this->uploadFile($request->file('slider_images_2'),'softcopy');
            $slid3 = $this->uploadFile($request->file('slider_images_3'),'softcopy');
            $slids = [
                'one' => $slid1,
                'two' => $slid2,
                'three' => $slid3,
            ];
            if($request->hasFile('slider_images_4')){
                $slid4 = $this->uploadFile($request->file('slider_images_4'),'softcopy');
                $slids['foure'] = $slid4;
            }
            $role =  Role::findOrFail($request->get('role_id'));
            $studioBranch = new StudioBranch();
            $studioBranch->name = $request->input('name');
            $studioBranch->description_en = $request->input('description_en');
            $studioBranch->description_ar = $request->input('description_ar');
            $studioBranch->email = $request->input('email');
            $studioBranch->mobile = $request->input('mobile');
            $studioBranch->address = $request->input('address');
            $studioBranch->latidute = $request->input('latitude');
            $studioBranch->longitude = $request->input('longitude');
            $studioBranch->is_lawful_service = $request->input('is_lawful_service');
            $studioBranch->password = Hash::make($request->input('password'));
            $studioBranch->city_id = $request->input('city_id');
            $studioBranch->region_id = $request->input('region_id');
            $studioBranch->type = $request->input('type');
            $studioBranch->active = $request->input('active');
            $studioBranch->slider_images = json_encode($slids);
            $studioBranch->studio_id = auth('studio')->user()->id;
            $studioBranch->currency_id = $city?->country?->currency_id ?? Currency::first()->id;
            $studioBranch->orderd = mt_rand(10,99);
            if($request->hasFile('avater')){
                $studioBranch->avater = $this->uploadFile($request->file('avater'));
            }
            $studioBranch->save();
            $studioBranch->assignRole($role);
            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function show(StudioBranch $studioBranch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function edit(StudioBranch $studioBranch)
    {
        $region = Region::where('active',true)->get();
        $roles = Role::where('guard_name','studiobranch')->get();
        $assignedRole = $studioBranch->roles()->first();
        $cities = City::where('active',true)->get();
        $objSlides = (object) json_decode($studioBranch->slider_images);
        $studioBranch->setAttribute('slides',$objSlides);
        return view('cms.studiosBranch.edit',['region' => $region,'cities' => $cities,'studio' => $studioBranch,'assignedRole' =>$assignedRole,'roles' =>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudioBranch $studioBranch)
    {
        $validator = Validator($request->all(), [
            'type' => 'required|string|in:branch,main',
            'name' => 'required|string',
            'email' => 'required|email|unique:studio_branches,email,'.$studioBranch->id,
            'mobile' => 'required|string|unique:studio_branches,mobile,'.$studioBranch->id,
            'address' => 'required|string',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'avater' => 'nullable|image|mimes:png,jpg',
            'role_id' => 'required|integer|exists:roles,id',
            'region_id' => 'required|integer|exists:regions,id',
            'city_id' => 'required|integer|exists:cities,id',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'active' => 'required|boolean',
            'is_lawful_service' => 'required|boolean',
            'orderd' => 'nullable|integer|unique:studio_branches,orderd,'.$studioBranch->id,
            'slider_images_1' => 'nullable|image|mimes:png,jpg',
            'slider_images_2' => 'nullable|image|mimes:png,jpg',
            'slider_images_3' => 'nullable|image|mimes:png,jpg',
            'slider_images_4' => 'nullable|image|mimes:png,jpg',
        ]);
        if (!$validator->fails()) {
            $city = City::find($request->city_id);
            $objSlides = (object) json_decode($studioBranch->slider_images);
            $slids = [
                'one' => $objSlides->one ?? '',
                'two' => $objSlides->two ?? '',
                'three' => $objSlides->three?? '',
                'foure' => $objSlides->foure?? '',
            ];
            if($request->hasFile('slider_images_1')){
                $slid1 = $this->uploadFile($request->file('slider_images_1'),'bookingstudio');
                $slids['one'] = $slid1;
            }
            if($request->hasFile('slider_images_3')){
                $slid2 = $this->uploadFile($request->file('slider_images_3'),'bookingstudio');
                $slids['two'] = $slid2;

            }
            if($request->hasFile('slider_images_3')){
                $slid3 = $this->uploadFile($request->file('slider_images_3'),'bookingstudio');
                $slids['three'] = $slid3;
            }
            
            if($request->hasFile('slider_images_4')){
                $slid4 = $this->uploadFile($request->file('slider_images_4'),'bookingstudio');
                $slids['foure'] = $slid4;
            }

            $role =  Role::findOrFail($request->get('role_id'));
            $studioBranch->name = $request->input('name');
            $studioBranch->description_en = $request->input('description_en');
            $studioBranch->description_ar = $request->input('description_ar');
            $studioBranch->email = $request->input('email');
            $studioBranch->is_lawful_service = $request->input('is_lawful_service');
            $studioBranch->mobile = $request->input('mobile');
            $studioBranch->address = $request->input('address');
            $studioBranch->latidute = $request->input('latitude');
            $studioBranch->longitude = $request->input('longitude');
            $studioBranch->city_id = $request->input('city_id');
            $studioBranch->type = $request->input('type');
            $studioBranch->region_id = $request->input('region_id');
            $studioBranch->active = $request->input('active');
            $studioBranch->currency_id = $city?->country?->currency_id ?? Currency::first()->id;
            if(!is_null($request->orderd)){
                $studioBranch->orderd = $request->orderd;
            }
            if($request->hasFile('avater')){
                $studioBranch->avater = $this->uploadFile($request->file('avater'));
            }
            if(count($slids) > 0){
                $studioBranch->slider_images = json_encode($slids);
            }
            $studioBranch->save();
            $studioBranch->assignRole($role);
            return ControllersService::generateProcessResponse(true,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudioBranch $studioBranch)
    {
        $studioBranch->delete();
        return response()->json([
            'status' => true,
            'message' => Messages::getMessage('SUCCESS'),
        ],Response::HTTP_OK);
    }
    
    public function showServices(StudioBranch $studioBranch){
        $services = ServiceStudio::where('active',true)->get();
        $studioServices = $studioBranch->services;
        foreach($services as $service){
            $service->setAttribute('assign',false);
            foreach($studioServices as $stdService){
                if($stdService->id == $service->id){
                    $service->setAttribute('assign',true);
                }
            }
        }
        return view('cms.studios.studio-services',['data' => $services,'studioBranch' => $studioBranch]);
    }

    public function setServices(Request $request,StudioBranch $studioBranch){
        $validator = Validator($request->all(), [
            'serviceId' => 'required|integer|exists:service_studios,id'
        ]);
        if (!$validator->fails()) {
            if($studioBranch->studio_id != auth()->user()->id){
                return response()->json(['message' => Messages::getMessage('FORBIDDEN')], Response::HTTP_BAD_REQUEST);
            }
            $serv = StudioService::where('studio_branch_id',$studioBranch->id)->where('service_studio_id',$request->input('serviceId'))->first();
            $isExists = $serv != null;
            if($isExists){
                $serv->delete();
            }else{
                StudioService::create([
                    'studio_branch_id' => $studioBranch->id,
                    'service_studio_id' => $request->input('serviceId')
                ]);
            }
            
            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
        
    }
}
