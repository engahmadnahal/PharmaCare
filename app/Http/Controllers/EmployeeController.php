<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Models\City;
use App\Models\Country;
use App\Models\Employee;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('cms.employees.index', ['data' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('guard_name', 'admin')->get();
        $countries = Country::where('active', true)->get();
        $cities = City::where('active', true)->get();
        $regions = Region::where('active', true)->get();

        return view('cms.employees.create', ['roles' => $roles, 'countries' => $countries, 'cities' => $cities, 'regions' => $regions]);
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email',
            'mobile' => 'required|string|unique:doctors,mobile',
            'country_id' => 'required|integer|countries,id',
            'city_id' => 'required|integer|cities,id',
            'region_id' => 'required|integer|regions,id',
            'address' => 'required|string|max:255',
            'avater' => 'required|image|mimes:png,jpg',
            'national_id' => 'required|string|unique:doctors,national_id',
            'certificate' => 'required|file|mimes:pdf',
            'dob' => 'required|date',
            'role_id' => 'required|integer|exists:roles,id',
        ]);
        if (!$validator->fails()) {
            $role =  Role::findOrFail($request->get('role_id'));
            $employee = new Employee();
            $employee->name = $request->input('name');
            $employee->country_id = $request->input('country_id');
            $employee->city_id = $request->input('city_id');
            $employee->region_id = $request->input('region_id');
            $employee->dob = $request->input('dob');
            $employee->email = $request->input('email');
            $employee->mobile = $request->input('mobile');
            $employee->address = $request->input('address');
            $employee->avater = $this->uploadFile($request->file('avater'));
            $employee->certificate = $this->uploadFile($request->file('certificate'));
            $employee->national_id = $request->input('national_id');
            $employee->password = Hash::make('password');
            $isSave = $employee->save();
            if ($isSave) {
                $employee->assignRole($role);
            }
            return ControllersService::generateProcessResponse($isSave, 'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $roles = Role::where('guard_name', 'admin')->get();
        $assignedRole = $employee->roles()->first();
        $countries = Country::where('active', true)->get();
        $cities = City::where('active', true)->get();
        $regions = Region::where('active', true)->get();

        return view('cms.employees.edit', ['admin' => $employee, 'roles' => $roles, 'assignedRole' => $assignedRole, 'countries' => $countries, 'cities' => $cities, 'regions' => $regions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validator = Validator($request->all(), [
            'country_id' => 'required|integer|countries,id',
            'city_id' => 'required|integer|cities,id',
            'region_id' => 'required|integer|regions,id',
            'dob' => 'required|date',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'mobile' => 'required|string|unique:employees,mobile,' . $employee->id,
            'address' => 'required|string|max:255',
            'avater' => 'nullable|image|mimes:png,jpg',
            'certificate' => 'nullable|file|mimes:pdf',
            'national_id' => 'required|string|unique:employees,national_id,' . $employee->id,
            'role_id' => 'required|integer|exists:roles,id',
        ]);
        if (!$validator->fails()) {


            $employee->name = $request->input('name');
            $employee->email = $request->input('email');
            $employee->mobile = $request->input('mobile');
            $employee->address = $request->input('address');
            $employee->country_id = $request->input('country_id');
            $employee->city_id = $request->input('city_id');
            $employee->region_id = $request->input('region_id');
            $employee->dob = $request->input('dob');
            $employee->address = $request->input('national_id');

            if ($request->hasFile('avater')) {
                $employee->avater = $this->uploadFile($request->file('avater'));
            }

            if ($request->hasFile('certificate')) {
                $employee->certificate = $this->uploadFile($request->file('certificate'));
            }
            $isSave = $employee->save();
            if ($isSave) {
                $role =  Role::findOrFail($request->get('role_id'));
                $employee->assignRole($role);
            }
            return ControllersService::generateProcessResponse($isSave, 'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $deleted = $employee->delete();

        return response()->json([
            'status' => $deleted,
            'message' => Messages::getMessage('SUCCESS'),
        ], Response::HTTP_OK);
    }
}
