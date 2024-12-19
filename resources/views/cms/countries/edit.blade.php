@extends('cms.parent')

@section('page-name',__('cms.countries'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.countries'))
@section('page-name-small',__('cms.update'))

@section('styles')

@endsection

@section('content')
<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title"></h3>
                
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.currency')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="currency_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($currency as $c)
                                    <option value="{{$c->id}}" @selected($c->id == $country->currency_id)>{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.currency')}}</span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>

                    <x-input name="{{__('cms.name_ar')}}" type="text" id="name_ar" value="{{$country->name_ar}}"/>
                    <x-input name="{{__('cms.name_en')}}" type="text" id="name_en" value="{{$country->name_en}}"/>
                    {{-- <x-input name="{{__('cms.longitude')}}" type="text" id="longitude" value="{{$country->longitude}}"/>
                    <x-input name="{{__('cms.latitude')}}" type="text" id="latitude" value="{{$country->latitude}}"/> --}}
                    <x-input name="{{__('cms.code')}}" type="text" id="code" value="{{$country->code}}"/>
                        {{-- <x-input name="{{__('cms.tax')}}" type="number" id="tax" value="{{$country->tax}}"/> --}}

                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.settings')}}</h3>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.active')}}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" @checked($country->active) id="active">
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
        let data = {
            code: document.getElementById('code').value,
            name_ar: document.getElementById('name_ar').value,
            name_en: document.getElementById('name_en').value,
            // longitude: document.getElementById('longitude').value,
            // tax: document.getElementById('tax').value,
            // latitude: document.getElementById('latitude').value,
            currency_id: document.getElementById('currency_id').value,
            active: document.getElementById('active').checked,
        }
        update('/cms/admin/countries/{{$country->id}}', data, '/cms/admin/countries');
    }
</script>
@endsection