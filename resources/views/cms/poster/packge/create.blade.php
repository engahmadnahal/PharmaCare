@extends('cms.parent')

@section('page-name',__('cms.package'))
@section('main-page',__('cms.services'))
@section('sub-page',__('cms.poster'))
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
                        <label class="col-3 col-form-label">{{__('cms.size_or_type')}}:<span
                                class="text-danger">*</span></label>

                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="option_posterprint_service_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($optionPoster as $s)
                                        <option value="{{$s->id}}">{{$s->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.size_or_type')}}</span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                   

                    <x-textarea name="{{__('cms.description_ar')}}" id="description_ar" />
                    <x-textarea name="{{__('cms.description_en')}}" id="description_en" dir="ltr"/>

                    <x-input type="number" name="{{ __('cms.min_item') }} " id="min_item" />

                    <x-input type="number" name="{{ __('cms.num_item_over') }} " id="num_item_over" />
                    @foreach ($currency as $crr)
                            <x-input type="text" name="{{ __('cms.price') }} {{$crr->name}}" id="price_{{$crr->id}}" />
                        @endforeach

                        <x-input type="number" name="{{ __('cms.discount_value') }}" id="discount_value"/>
                   


                        <div class="form-group row mt-4">
                            <label class="col-3 col-form-label">{{__('cms.unit_size_image')}}:<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-4 col-md-9 col-sm-12">
                                <div class="dropdown bootstrap-select form-control dropup">
                                    <select class="form-control selectpicker" data-size="7" id="type_size"
                                        title="Choose one of the following..." tabindex="null" data-live-search="true">
                                        <option value="KB" >KB</option>
                                        <option value="MG" >MG</option>
                                    </select>
                                </div>
                                <span class="form-text text-muted">{{__('cms.please_select')}}
                                    {{__('cms.size_or_type')}}</span>
                            </div>
                        </div>

                <x-input type="number" name="{{ __('cms.min_size_image') }} " id="min_size_image" />

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
        let currences = [
                @foreach ($currency as $crr)
                {
                    currncyId : {{$crr->id}},
                    value : document.getElementById('price_{{$crr->id}}').value,
                },
                @endforeach
            ];
        formData.append('price', JSON.stringify(currences));
        formData.append('min_size_image', document.getElementById('min_size_image').value);
        formData.append('type_size', document.getElementById('type_size').value);
        formData.append('discount_value', document.getElementById('discount_value').value);
        formData.append('option_posterprint_service_id',document.getElementById('option_posterprint_service_id').value);
        formData.append('description_en',document.getElementById('description_en').value);
        formData.append('description_ar',document.getElementById('description_ar').value);
        formData.append('num_item_over',document.getElementById('num_item_over').value);
        formData.append('min_item',document.getElementById('min_item').value);
        
        formData.append('image',document.getElementById('image').files[0]);
        store('/cms/admin/packge_poster_services',formData);
    }
</script>
@endsection