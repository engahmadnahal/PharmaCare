@extends('cms.parent')

@section('page-name',__('cms.ads'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.ads'))
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
                    <x-input name="{{__('cms.title_ar')}}" type="text" id="title_ar" value="{{$data->title_ar}}"/>
                    <x-input name="{{__('cms.title_en')}}" type="text" id="title_en" value="{{$data->title_en}}"/>

                        <div class="form-group ">
                            <label class="col-12 col-form-label">{{ __('cms.image') }}:</label>
                            <div class="col-9">
                                <div class="image-input image-input-empty image-input-outline" id="kt_image_6"
                                    style="background-image: url({{Storage::url($data->image)}})">
                                    <div class="image-input-wrapper"></div>
        
                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="image" id="image" accept=".png, .jpg, .jpeg">
                                        <input type="hidden" name="image">
                                    </label>
        
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
        
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
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
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="performEdit({{$data->id}})"
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
    var cover = new KTImageInput('kt_image_6');

    function performEdit(){

        let formData = new FormData();
        formData.append('title_ar',document.getElementById('title_ar').value);
        formData.append('title_en',document.getElementById('title_en').value);
        formData.append('active',document.getElementById('active').checked ? 1 : 0);
        formData.append('image',document.getElementById('image').files[0] ? document.getElementById('image').files[0] : '');
        formData.append('_method','put');
        store('/cms/admin/ads/{{$data->id}}', formData, '/cms/admin/ads');
    }
</script>
@endsection