<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Http\Trait\CustomTrait;
use App\Models\City;
use App\Models\Country;
use App\Models\OwnerStudio;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class OwnerStudioController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = OwnerStudio::all();
        return view('cms.owner.index',[
            'data' => $data,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::where('active',true)->get();
        $cities = City::where('active',true)->get();
        $regions = Region::where('active',true)->get();
        $roles = Role::where('guard_name','owner')->get();
        return view('cms.owner.create',[
            'countries' => $countries,
            'cities' => $cities,
            'regions' => $regions,
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(),[
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email|unique:owner_studios,email',
            'mobile' => 'required|string|unique:owner_studios,mobile',
            'address' => 'required|string',
            'password' => 'required|string',
            'avater' => 'required|image|mimes:png,jpg',
            'national_id' => 'required|string|unique:owner_studios,national_id',
            'role_id' => 'required|integer|exists:roles,id',
            'active' => 'required|boolean',
            'country_id' => 'required|numeric|exists:countries,id',
            'city_id' => 'required|numeric|exists:cities,id',
            'region_id' => 'required|numeric|exists:regions,id',
        ]);
        if(!$validator->fails()){
            $ownerStudio = new OwnerStudio();
            $ownerStudio->fname = $request->input('fname');
            $ownerStudio->lname = $request->input('lname');
            $ownerStudio->email = $request->input('email');
            $ownerStudio->password = Hash::make($request->input('password'));
            $ownerStudio->mobile = $request->input('mobile');
            $ownerStudio->address = $request->input('address');
            $ownerStudio->avater = $this->uploadFile($request->file('avater'));
            $ownerStudio->national_id = $request->input('national_id');
            $ownerStudio->country_id = $request->input('country_id');
            $ownerStudio->city_id = $request->input('city_id');
            $ownerStudio->region_id = $request->input('region_id');
            $isSave = $ownerStudio->save();

            $ownerStudio->assignRole(Role::findOrFail($request->role_id));
            return ControllersService::generateProcessResponse($isSave,'CREATE');
        }else{
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OwnerStudio  $ownerStudio
     * @return \Illuminate\Http\Response
     */
    public function show(OwnerStudio $ownerStudio)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OwnerStudio  $ownerStudio
     * @return \Illuminate\Http\Response
     */
    public function edit(OwnerStudio $ownerStudio)
    {
        $assignedRole = $ownerStudio->roles()->first();
        $countries = Country::where('active',true)->get();
        $cities = City::where('active',true)->get();
        $regions = Region::where('active',true)->get();
        $roles = Role::where('guard_name','owner')->get();
        return view('cms.owner.edit',[
            'data' => $ownerStudio,
            'countries' => $countries,
            'cities' => $cities,
            'regions' => $regions,
            'roles' => $roles,
            'assignedRole' => $assignedRole
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OwnerStudio  $ownerStudio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OwnerStudio $ownerStudio)
    {
        $validator = Validator($request->all(),[
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email|unique:owner_studios,email,'.$ownerStudio->id,
            'mobile' => 'required|string|unique:owner_studios,mobile,'.$ownerStudio->id,
            'address' => 'required|string',
            'password' => 'nullable|string',
            'avater' => 'nullable|image|mimes:png,jpg',
            'national_id' => 'required|string|unique:owner_studios,national_id,'.$ownerStudio->id,
            'role_id' => 'required|integer|exists:roles,id',
            'active' => 'required|boolean',
            'country_id' => 'required|numeric|exists:countries,id',
            'city_id' => 'required|numeric|exists:cities,id',
            'region_id' => 'required|numeric|exists:regions,id',
        ]);
        if(!$validator->fails()){
            $ownerStudio->fname = $request->input('fname');
            $ownerStudio->lname = $request->input('lname');
            $ownerStudio->email = $request->input('email');
            $ownerStudio->mobile = $request->input('mobile');
            $ownerStudio->password = Hash::make($request->input('password'));
            $ownerStudio->address = $request->input('address');
            if($request->hasFile('avater')){
                $ownerStudio->avater = $this->uploadFile($request->input('avater'));
            }
            $ownerStudio->national_id = $request->input('national_id');
            $ownerStudio->country_id = $request->input('country_id');
            $ownerStudio->city_id = $request->input('city_id');
            $ownerStudio->region_id = $request->input('region_id');
            $isSave = $ownerStudio->save();

            $ownerStudio->assignRole(Role::findById($request->role_id,'owner'));
            return ControllersService::generateProcessResponse($isSave,'UPDATE');
        }else{
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OwnerStudio  $ownerStudio
     * @return \Illuminate\Http\Response
     */
    public function destroy(OwnerStudio $ownerStudio)
    {
        return $this->destroyTrait($ownerStudio);
    }
}
