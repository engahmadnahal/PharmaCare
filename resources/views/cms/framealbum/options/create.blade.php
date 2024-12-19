@extends('cms.parent')

@section('page-name',__('cms.size_or_type'))
@section('main-page',__('cms.services'))
@section('sub-page',__('cms.size_or_type'))
@section('page-name-small',__('cms.create'))

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
                        <label class="col-3 col-form-label">{{__('cms.frameAlbum')}}:<span
                                class="text-danger">*</span></label>

                                
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="frame_album_service_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($frame as $s)
                                        <option value="{{$s->id}}">{{$s->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.frameAlbum')}}</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.type')}}:<span
                                class="text-danger">*</span></label>

                                
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="type"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    <option value="frame" >{{__('cms.frame')}}</option>
                                    <option value="album">{{__('cms.album')}}</option>
                                    
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.type')}}</span>
                        </div>
                    </div>
                    
                    <div class="separator separator-dashed my-10"></div>
                   
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.title_ar')}}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="title_ar" placeholder="{{__('cms.title_ar')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.title_ar')}}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.title_en')}}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="title_en" placeholder="{{__('cms.title_en')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.title_en')}}</span>
                        </div>
                    </div>

                    {{-- @foreach ($currency as $crr)
                            <x-input type="number" name="{{ __('cms.price') }} {{$crr->name}}" id="price_{{$crr->id}}"/>
                        @endforeach --}}


                    <div class="form-group ">
                        <label class="col-12 col-form-label">{{ __('cms.image') }}:</label>
                        <div class="col-9">
                            <div class="image-input image-input-empty image-input-outline" id="kt_image_6"
                                style="background-image: url({{ asset('assets/media/users/blank.png') }})">
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

                   

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.status')}}</label>
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
                            <button type="button" onclick="performStore()"
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
    
    function performStore(){
        let formData = new FormData();
        // let currences = [
        //         @foreach ($currency as $crr)
        //         {
        //             currncyId : {{$crr->id}},
        //             value : document.getElementById('price_{{$crr->id}}').value,
        //         },
        //         @endforeach
        //     ];
        // formData.append('price', JSON.stringify(currences));
        formData.append('type',document.getElementById('type').value);
        formData.append('frame_album_service_id',document.getElementById('frame_album_service_id').value);
        formData.append('title_ar',document.getElementById('title_ar').value);
        formData.append('title_en',document.getElementById('title_en').value);
        formData.append('image',document.getElementById('image').files[0]);
        formData.append('active',document.getElementById('active').checked?1:0);
        store('/cms/admin/option_frame_album_services',formData);
    }
</script>
@endsection