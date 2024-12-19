@extends('cms.parent')

@section('page-name',__('cms.term'))
@section('main-page',__('cms.settings'))
@section('sub-page',__('cms.term'))
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
                    
                    <x-input name="{{__('cms.title_ar')}}" type="text" id="title_ar" value="{{$data->title_ar}}"/>
                        <x-input name="{{__('cms.title_en')}}" type="text" id="title_en" value="{{$data->title_en}}" dir="ltr"/>
                        <x-textarea name="{{__('cms.body_ar')}}" type="text" id="body_ar" value="{{$data->body_ar}}"/>
                    <x-textarea name="{{__('cms.body_en')}}" type="text" id="body_en" value="{{$data->body_en}}" dir="ltr"/>
                    <x-image id="image" value="{{Storage::url($data->image)}}"/>

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
    var cover = new KTImageInput('kt_image_image');

    function performEdit(){
        let formData = new FormData();
        formData.append('title_ar',document.getElementById('title_ar').value);
        formData.append('title_en',document.getElementById('title_en').value);
        formData.append('body_ar',document.getElementById('body_ar').value);
        formData.append('body_en',document.getElementById('body_en').value);
        formData.append('image',document.getElementById('image').files[0]);
        formData.append('_method','put');
        store('/cms/admin/term_users/{{$data->id}}',formData,'/cms/admin/term_users');
    }
</script>
@endsection