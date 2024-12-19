<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Http\Trait\CustomTrait;
use App\Models\BookingStudioService;
use App\Models\Currency;
use App\Models\ServicesBookingStudio;
use App\Models\ServicesBookingStudioBranch;
use App\Models\StudioBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ServicesBookingStudioController extends Controller
{
    use CustomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ServicesBookingStudio::all();
        return view('cms.bookingstudio.services.index',[
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currency = Currency::all();
        $masterServices = BookingStudioService::where('active',true)->get();
        return view('cms.bookingstudio.services.create',[
            'currency' => $currency,
            'masterServices' => $masterServices

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
        $validator = Validator($request->all(), [
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'price.*.currncyId' => 'required|integer',
            'price.*.value' => 'required|numeric',
            'price_after_increse.*.currncyId' => 'required|numeric|exists:currencies,id',
            'price_after_increse.*.value' => 'required|numeric',
            'num_photo' => 'required|numeric',
            'num_add' => 'required|numeric',
            'booking_studio_service_id' => 'required|numeric|exists:booking_studio_services,id'
            
        ]);
        if (!$validator->fails()) {
            $saved = DB::transaction(function() use($request){

                $serviceStudio = new ServicesBookingStudio();
                $serviceStudio->num_photo = $request->input('num_photo');
                $serviceStudio->num_add = $request->input('num_add');
                $serviceStudio->title_ar = $request->input('title_ar');
                $serviceStudio->title_en = $request->input('title_en');
                $serviceStudio->description_ar = $request->input('description_ar');
                $serviceStudio->description_en = $request->input('description_en');
                $serviceStudio->booking_studio_service_id = $request->input('booking_studio_service_id');
                $saved = $serviceStudio->save();
                
                foreach ($request->input('price') as $price) {
                    $price = (object) $price;
                    $savedPrice = $serviceStudio->price()->create([
                        'currency_id' => $price->currncyId,
                        'price' => $price->value
                    ]);
                }


                    
                    foreach ($request->input('price_after_increse') as $price) {
                        $price = (object) $price;
                        $serviceStudio->priceAfterIncres()->create([
                            'currency_id' => $price->currncyId,
                            'price' => $price->value
                        ]);
                    }



                return $saved && $savedPrice;
            });
            return ControllersService::generateProcessResponse($saved,'CREATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServicesBookingStudio  $servicesBookingStudio
     * @return \Illuminate\Http\Response
     */
    public function show(ServicesBookingStudio $servicesBookingStudio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServicesBookingStudio  $servicesBookingStudio
     * @return \Illuminate\Http\Response
     */
    public function edit(ServicesBookingStudio $servicesBookingStudio)
    {
        $currency = Currency::all();
        $masterServices = BookingStudioService::where('active',true)->get();
        return view('cms.bookingstudio.services.edit',[
            'data' => $servicesBookingStudio,
            'currency' => $currency,
            'masterServices' => $masterServices
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServicesBookingStudio  $servicesBookingStudio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServicesBookingStudio $servicesBookingStudio)
    {
        $validator = Validator($request->all(), [
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'price.*.currncyId' => 'required|integer',
            'price.*.value' => 'required|numeric',
            'price_after_increse.*.currncyId' => 'required|numeric|exists:currencies,id',
            'price_after_increse.*.value' => 'required|numeric',
            'price_after_increse.*.currncyId' => 'required|numeric|exists:currencies,id',
            'price_after_increse.*.value' => 'required|numeric',
            'num_photo' => 'required|numeric',
            'num_add' => 'required|numeric',
            'booking_studio_service_id' => 'required|numeric|exists:booking_studio_services,id'

        ]);
        if (!$validator->fails()) {
            $saved = DB::transaction(function () use($servicesBookingStudio,$request){
                
                $servicesBookingStudio->num_photo = $request->input('num_photo');
                $servicesBookingStudio->num_add = $request->input('num_add');
                $servicesBookingStudio->title_ar = $request->input('title_ar');
                $servicesBookingStudio->title_en = $request->input('title_en');
                $servicesBookingStudio->description_ar = $request->input('description_ar');
                $servicesBookingStudio->description_en = $request->input('description_en');
                $servicesBookingStudio->booking_studio_service_id = $request->input('booking_studio_service_id');
                $saved = $servicesBookingStudio->save();
                
                if($servicesBookingStudio->price()->delete() || $servicesBookingStudio->price()->count() == 0){
                    foreach ($request->input('price') as $price) {
                        $price = (object) $price;
                        $savedPrice = $servicesBookingStudio->price()->create([
                            'currency_id' => $price->currncyId,
                            'price' => $price->value
                        ]);
                    }
                }

                if($servicesBookingStudio->priceAfterIncres()->delete() || $servicesBookingStudio->priceAfterIncres()->count() == 0){
                    foreach ($request->input('price_after_increse') as $price) {
                        $price = (object) $price;
                        $servicesBookingStudio->priceAfterIncres()->create([
                            'currency_id' => $price->currncyId,
                            'price' => $price->value
                        ]);
                    }
                }

                return $saved && $savedPrice;
            });

            return ControllersService::generateProcessResponse($saved,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServicesBookingStudio  $servicesBookingStudio
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServicesBookingStudio $servicesBookingStudio)
    {
        return $this->destroyTrait($servicesBookingStudio);
    }

    
    public function services(){
        $studioBranch = auth()->user();
        $bookginServicesStudio = ServicesBookingStudio::all();
        $studioServices = $studioBranch->bookginServicesStudio;
        foreach($bookginServicesStudio as $service){
            $service->setAttribute('assign',false);
            foreach($studioServices as $stdService){
                if($stdService->id == $service->id){
                    $service->setAttribute('assign',true);
                }
            }
        }
        return view('cms.bookingstudio.services.studio-services',['data' => $bookginServicesStudio,'studioBranch' => $studioBranch]);
    }

    public function setServices(Request $request,StudioBranch $studioBranch){
        $validator = Validator($request->all(), [
            'serviceId' => 'required|integer|exists:services_booking_studios,id'
        ]);
        if (!$validator->fails()) {
            // if($studioBranch->studio_id != auth()->user()->id){
            //     return response()->json(['message' => Messages::getMessage('FORBIDDEN')], Response::HTTP_BAD_REQUEST);
            // }
            $serv = ServicesBookingStudioBranch::where('studio_branch_id',$studioBranch->id)->where('services_id',$request->input('serviceId'))->first();
            $isExists = $serv != null;
            if($isExists){
                $save = $serv->delete();
            }else{
                $save = ServicesBookingStudioBranch::create([
                    'studio_branch_id' => $studioBranch->id,
                    'services_id' => $request->input('serviceId')
                ]);
            }
            
            return ControllersService::generateProcessResponse((bool) $save,'UPDATE');
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
        
    }

}
