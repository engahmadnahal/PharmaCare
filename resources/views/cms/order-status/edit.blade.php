@extends('cms.parent')

@section('page-name',__('cms.order_status'))
@section('main-page',__('cms.settings'))
@section('sub-page',__('cms.order_status'))
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
                <h3 class="card-title">{{__('cms.update')}}</h3>
                
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.name_ar')}}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="name_ar" placeholder="{{__('cms.name_ar')}}" value="{{$data->name_ar}}"/>
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.name_ar')}}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.name_en')}}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="name_en" placeholder="{{__('cms.name_en')}}" value="{{$data->name_en}}"/>
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.name_en')}}</span>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.settings')}}</h3>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.active')}}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" @checked($data->active) id="active">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.is_faild')}} ({{__('cms.desc_is_faild')}})</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" @checked($data->is_faild) id="is_faild">
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
                            <button type="button" onclick="performEdit('{{$data->id}}')"
                                class="btn btn-primary mr-2">{{__('cms.update')}}</button>
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
    var cover = new KTImageInput('kt_image_6');
  
    
    function performEdit(id){
        let formData = new FormData();
        formData.append('name_ar',document.getElementById('name_ar').value);
        formData.append('name_en',document.getElementById('name_en').value);
        formData.append('active',document.getElementById('active').checked ? 1 : 0);
        formData.append('is_faild',document.getElementById('is_faild').checked ? 1 : 0);
        formData.append('_method','put');
        store('/cms/admin/order_statuses/'+id, formData, '/cms/admin/order_statuses');
    }
</script>
@endsection