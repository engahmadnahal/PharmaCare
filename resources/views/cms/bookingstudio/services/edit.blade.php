@extends('cms.parent')

@section('page-name',__('cms.serviceStudio'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.serviceStudio'))
@section('page-name-small',__('cms.update'))

@section('styles')

@endsection

@section('content')
<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">
       {{-- {{dd(isset($data['country']));}} --}}
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">
                    
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.services_booking_studios')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="booking_studio_service_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($masterServices as $service)
                                    <option value="{{$service->id}}" @selected($service->id == $data->booking_studio_service_id)>{{$service->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.services_booking_studios')}}</span>
                        </div>
                    </div>

                    <x-input name="{{__('cms.title_ar')}}" type="text" id="title_ar" value="{{$data->title_ar}}"/>
                    <x-input name="{{__('cms.title_en')}}" type="text" id="title_en" value="{{$data->title_en}}"/>

                    <x-textarea name="{{__('cms.description_ar')}}" type="text" id="description_ar" value="{{$data->description_ar}}"/>
                    <x-textarea name="{{__('cms.description_en')}}" type="text" id="description_en" dir="ltr" value="{{$data->description_en}}"/>
                    
                    <x-input type="text" name="{{ __('cms.num_photo') }}" id="num_photo" value="{{$data->num_photo}}"/>
                    <x-input type="text" name="{{ __('cms.num_add') }}" id="num_add" value="{{$data->num_add}}"/>


                    @foreach ($currency as $crr)
                        <x-input type="number" name="{{ __('cms.price') }} {{$crr->name}}" id="price_{{$crr->id}}" value="{{$data->price->where('currency_id',$crr->id)->first()?->price}}"/>
                        <x-input type="text" name="{{ __('cms.price_elm') }} / {{$crr->name}}" id="price_after_increse_{{$crr->id}}" value="{{$data->priceAfterIncres->where('currency_id',$crr->id)->first()?->price}}"/>
                    @endforeach  

                
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="performEdit()"
                                class="btn btn-primary mr-2">{{__('cms.save')}}</button>
                            <button type="reset" class="btn btn-secondary">{{__('cms.cancel')}}</button>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
</div>
<!--end::Container-->
@endsection

@section('scripts')
<script>
    function performEdit(){
        let currences = [
                @foreach ($currency as $crr)
                {
                    currncyId : {{$crr->id}},
                    value : document.getElementById('price_{{$crr->id}}').value,
                },
                @endforeach
            ];


            let price_after_increse = [
                @foreach ($currency as $crr)
                {
                    currncyId : {{$crr->id}},
                    value : document.getElementById('price_after_increse_{{$crr->id}}').value,
                },
                @endforeach
            ];


        let data = {
            price_after_increse : price_after_increse,
            price : currences,
            title_ar: document.getElementById('title_ar').value,
            title_en: document.getElementById('title_en').value,
            num_add : document.getElementById('num_add').value,
            num_photo : document.getElementById('num_photo').value,
            description_ar: document.getElementById('description_ar').value,
            description_en: document.getElementById('description_en').value,
            booking_studio_service_id: document.getElementById('booking_studio_service_id').value,
            

        }
        update('/cms/admin/services_booking_studios/{{$data->id}}', data, '/cms/admin/services_booking_studios');
    }
</script>
@endsection