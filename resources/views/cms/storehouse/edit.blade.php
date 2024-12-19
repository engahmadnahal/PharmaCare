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
                        <label class="col-3 col-form-label">{{__('cms.cities')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="city_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($cities as $c)
                                    <option value="{{$c->id}}" @selected($c->id == $storeHouse->city_id)>{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.cities')}}</span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                   
                    
                    <x-input name="{{__('cms.name_ar')}}" type="text" id="name_ar" value="{{$storeHouse->name_ar}}"/>
                    <x-input name="{{__('cms.name_en')}}" type="text" id="name_en" value="{{$storeHouse->name_en}}" dir="ltr"/>

                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.settings')}}</h3>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.active')}}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" @checked($storeHouse->active) id="active">
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
                            <button type="button" onclick="performEdit({{$storeHouse->id}})"
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
        blockUI();
        let data = {
            city_id: document.getElementById('city_id').value,
            name_ar: document.getElementById('name_ar').value,
            name_en: document.getElementById('name_en').value,
            active: document.getElementById('active').checked,
        }
        update('/cms/admin/store_houses/{{$storeHouse->id}}', data, '/cms/admin/store_houses');
    }
</script>
@endsection