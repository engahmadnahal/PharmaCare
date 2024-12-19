<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Trait\CustomTrait;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\Region;
use App\Models\ServiceStudio;
use App\Models\Studio;
use App\Models\StudioBranch;
use App\Models\StudioService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class StudioController extends Controller
{

    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Studio::all();
        return view('cms.studios.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::where('guard_name','studio')->get();
        $cities = City::where('active',true)->get();
        $region = Region::where('active',true)->get();
        return view('cms.studios.create',['cities' => $cities,'roles' =>$roles,'region' => $region]);
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
            'email' => 'required|email|unique:studios,email',
            'mobile' => 'required|string|unique:studios,mobile',
            'address' => 'required|string',
            'avater' => 'required|image|mimes:png,jpg',
            'role_id' => 'required|integer|exists:roles,id',
            'city_id' => 'required|integer|exists:cities,id',
            'region_id' => 'required|integer|exists:regions,id',
            'password' => 'required|string|min:6|max:12',
            'active' => 'required|boolean'
        ]);
        if (!$validator->fails()) {
            $role =  Role::findOrFail($request->get('role_id'));
            $studio = new Studio();
            $studio->name = $request->input('name');
            $studio->email = $request->input('email');
            $studio->mobile = $request->input('mobile');
            $studio->address = $request->input('address');
            $studio->password = Hash::make($request->input('password'));
            $studio->city_id = $request->input('city_id');
            $studio->region_id = $request->input('region_id');
            $studio->type = 'main';
            $studio->active = $request->input('active');
            if($request->hasFile('avater')){
                $studio->avater = $this->uploadFile($request->file('avater'));
            }
            $studio->save();
            $studio->assignRole($role);
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
    public function show(Studio $studio)
    {
        $currency = $studio->currencyCode;

        $stds = StudioBranch::where('studio_id',$studio->id)->pluck('id');
        $lastStudios = StudioBranch::where('studio_id',$studio->id)->orderBy('created_at','desc')->get(); 

        $orders = Order::with(['orderStatus','studioSendOrder','services','user'])->whereIn('studio_branch_id', $stds)->orderBy('created_at','desc')->get();
        $services = OrderService::with('order')->whereIn('order_id',$orders->pluck('id'))->get();

        $todayAmount = Order::whereIn('studio_branch_id',$stds)->whereDate('created_at',Carbon::today())->get()->sum('cost');
        $weekAmount = Order::whereIn('studio_branch_id',$stds)->whereBetween('created_at',$this->thisWeek())->get()->sum('cost');
        $monthAmount = Order::whereIn('studio_branch_id',$stds)->whereBetween('created_at',$this->thisMonth())->get()->sum('cost');
        $totalAmount = Order::whereIn('studio_branch_id',$stds)->get()->sum('cost');

        $todayOrder = Order::whereIn('studio_branch_id',$stds)->whereDate('created_at',Carbon::today())->count();
        $weekOrder = Order::whereIn('studio_branch_id',$stds)->whereBetween('created_at',$this->thisWeek())->count();;
        $monthOrder = Order::whereIn('studio_branch_id',$stds)->whereBetween('created_at',$this->thisMonth())->count();
        $totalOrder = Order::whereIn('studio_branch_id',$stds)->count();

        return view('cms.studios.show',[
            'data' => $studio,
            'orders' => $orders,
            'services' => $services,
            'currency' => $currency,
            'lastStudios' => $lastStudios,
            'todayAmount' => $todayAmount,
            'weekAmount' => $weekAmount,
            'monthAmount' => $monthAmount,
            'totalAmount' => $totalAmount,
            'todayOrder' => $todayOrder,
            'weekOrder' => $weekOrder,
            'monthOrder' => $monthOrder,
            'totalOrder' => $totalOrder,
        ]);
    }

    private function thisWeek(){
        $startWeek = Carbon::now()->startOfWeek();
        $endWeek = Carbon::now()->endOfWeek();
        return [$startWeek,$endWeek];
    }

    private function thisMonth(){
        $startMonth = Carbon::now()->startOfMonth();
        $endMonth = Carbon::now()->endOfMonth();
        return [$startMonth,$endMonth];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function edit(Studio $studio)
    {
        $roles = Role::where('guard_name','studio')->get();
        $assignedRole = $studio->roles()->first();
        $region = Region::where('active',true)->get();
        $cities = City::where('active',true)->get();
        return view('cms.studios.edit',['cities' => $cities,'studio' => $studio,'assignedRole' =>$assignedRole,'roles' =>$roles,'region' => $region]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studio $studio)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:studios,email,'.$studio->id,
            'mobile' => 'required|string|unique:studios,mobile,'.$studio->id,
            'address' => 'required|string',
            'avater' => 'nullable|image|mimes:png,jpg',
            'role_id' => 'required|integer|exists:roles,id',
            'city_id' => 'required|integer|exists:cities,id',
            'region_id' => 'required|integer|exists:regions,id',
            'active' => 'required|boolean'
        ]);
        if (!$validator->fails()) {
            $role =  Role::findOrFail($request->get('role_id'));
            $studio->name = $request->input('name');
            $studio->email = $request->input('email');
            $studio->mobile = $request->input('mobile');
            $studio->address = $request->input('address');
            $studio->city_id = $request->input('city_id');
            $studio->region_id = $request->input('region_id');
            $studio->active = $request->input('active');
            if($request->hasFile('avater')){
                $studio->avater = $this->uploadFile($request->file('avater'));
            }
            $studio->save();
            $studio->assignRole($role);
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
    public function destroy(Studio $studio)
    {
        $studio->delete();
        return response()->json([
            'status' => true,
            'message' => Messages::getMessage('SUCCESS'),
        ],Response::HTTP_OK);
    }

    
}
