@extends('cms.parent')

@section('page-name',__('cms.cities'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.cities'))
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
                {{-- <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                    </div>
                </div> --}}
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.countries')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="country_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($countries as $c)
                                    <option value="{{$c->id}}" @selected($c->id == $city->country_id)>{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.countries')}}</span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>

                    <x-input name="{{__('cms.name_ar')}}" type="text" id="name_ar" value="{{$city->name_ar}}"/>
                    <x-input name="{{__('cms.name_en')}}" type="text" id="name_en" value="{{$city->name_en}}"/>
                    {{-- <x-input name="{{__('cms.longitude')}}" type="text" id="longitude" value="{{$city->longitude}}"/>
                    <x-input name="{{__('cms.latitude')}}" type="text" id="latitude" value="{{$city->latitude}}"/> --}}
                    <x-input name="{{__('cms.code')}}" type="text" id="code" value="{{$city->code}}"/>

                        @foreach ($currency as $crr)
                        <x-input type="number" name="{{ __('cms.delivary_price') }} {{$crr->name}}" id="delivary_price_{{$crr->id}}" value="{{$city->price->where('currency_id',$crr->id)->first()?->price}}"/>
                    @endforeach
                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.settings')}}</h3>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.active')}}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" checked="checked" id="active">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="performEdit({{$city->id}})"
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
    function blockUI () {
        KTApp.blockPage({
            overlayColor: 'blue',
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });
    }

    function unBlockUI () {
        KTApp.unblockPage();
    }

</script>
<script>
    function performEdit(){
        let currences = [
                @foreach ($currency as $crr)
                {
                    currncyId : {{$crr->id}},
                    value : document.getElementById('delivary_price_{{$crr->id}}').value,
                },
                @endforeach
            ];
        let data = {
            country_id: document.getElementById('country_id').value,
            code: document.getElementById('code').value,
            name_ar: document.getElementById('name_ar').value,
            name_en: document.getElementById('name_en').value,
            // longitude: document.getElementById('longitude').value,
            // latitude: document.getElementById('latitude').value,
            active: document.getElementById('active').checked,
            delivary_price : currences,
        }
        update('/cms/admin/cities/{{$city->id}}', data, '/cms/admin/cities');
    }
</script>
@endsection