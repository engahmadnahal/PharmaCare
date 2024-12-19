<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Trait\CustomTrait;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $admins = Admin::all();
        return view('cms.admins.index',['data' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('guard_name','admin')->get();
        return view('cms.admins.create',['roles' => $roles]);

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
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'mobile' => 'required|string|unique:admins,mobile',
            'address' => 'required|string',
            'avater' => 'required|image|mimes:png,jpg',
            'national_id' => 'required|string|unique:admins,national_id',
            'password' => 'required|string|min:6|max:12',
            'role_id' => 'required|integer|exists:roles,id',
        ]);
        if (!$validator->fails()) {
            $role =  Role::findOrFail($request->get('role_id'));
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->mobile = $request->input('mobile');
            $admin->address = $request->input('address');
            $admin->avater = $this->uploadFile($request->file('avater'));
            $admin->national_id = $request->input('national_id');
            $admin->password = Hash::make($request->input('password'));
            $isSave = $admin->save();
            $admin->assignRole($role);
            return ControllersService::generateProcessResponse(true,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {

        $roles = Role::where('guard_name','admin')->get();
        $assignedRole = $admin->roles()->first();
        return view('cms.admins.edit',['admin' => $admin,'roles' => $roles,'assignedRole' => $assignedRole]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {

        $validator = Validator($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email,'.$admin->id,
            'mobile' => 'required|string|unique:admins,mobile,'.$admin->id,
            'address' => 'required|string',
            'avater' => 'nullable|image|mimes:png,jpg',
            'national_id' => 'required|string|unique:admins,national_id,'.$admin->id,
            'role_id' => 'required|integer|exists:roles,id',
        ]);
        if (!$validator->fails()) {
            $role =  Role::findOrFail($request->get('role_id'));
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->mobile = $request->input('mobile');
            $admin->address = $request->input('address');
            if($request->hasFile('avater')){
                $admin->avater = $this->uploadFile($request->file('avater'));
            }
            $admin->address = $request->input('national_id');
            $isSave = $admin->save();
            $admin->assignRole($role);
            return ControllersService::generateProcessResponse(true,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->json([
            'status' => true,
            'message' => Messages::getMessage('SUCCESS'),
        ],Response::HTTP_OK);
    }
}
