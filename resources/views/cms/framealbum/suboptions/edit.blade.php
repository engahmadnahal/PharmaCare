@extends('cms.parent')

@section('page-name',__('cms.options'))
@section('main-page',__('cms.services'))
@section('sub-page',__('cms.options'))
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
                        <label class="col-3 col-form-label">{{__('cms.size_or_type')}}:<span
                                class="text-danger">*</span></label>

                                
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="option_frame_album_service_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($optionFrame as $s)
                                        <option value="{{$s->id}}" @selected($s->id == $data->option_frame_album_service_id)>{{$s->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.size_or_type')}}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.type')}}:<span
                                class="text-danger">*</span></label>

                                
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="type"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    <option value="frame" @selected($data->type == 'frame')>{{__('cms.frame')}}</option>
                                    <option value="album" @selected($data->type == 'album')>{{__('cms.album')}}</option>
                                    
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.type')}}</span>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-10"></div>
                   

                    <x-input type="text" name="{{__('cms.title_ar')}}" id="title_ar" value="{{$data->title_ar}}"/>
                    <x-input type="text"  name="{{__('cms.title_en')}}" id="title_en" value="{{$data->title_en}}"/>

                        
                    <x-input type="text" name="{{__('cms.note_ar')}}" id="note_ar" value="{{$data->note_ar}}"/>
                    <x-input type="text"  name="{{__('cms.note_en')}}" id="note_en" value="{{$data->note_en}}"/>
                            
                    <x-textarea name="{{__('cms.description_ar')}}" id="description_ar" value="{{$data->description_ar}}"/>
                    <x-textarea name="{{__('cms.description_en')}}" id="description_en" value="{{$data->description_en}}"/>

                    <x-input type="number" name="{{__('cms.num_photo')}}" id="num_photo" value="{{$data->num_photo}}"/>


                        {{-- @foreach ($currency as $crr)
                        <x-input type="number" name="{{ __('cms.price') }} {{$crr->name}}" id="price_{{$crr->id}}" value="{{$data->price->where('currency_id',$crr->id)->first()?->price}}"/>
                    @endforeach --}}


                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.unit_size_image')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="type_size"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    <option value="KB" @selected($data->type_size == "KB")>KB</option>
                                    <option value="MG" @selected($data->type_size == "MG")>MG</option>
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.size_or_type')}}</span>
                        </div>
                    </div>

            <x-input type="number" name="{{ __('cms.min_size_image') }} " id="min_size_image" value="{{$data->min_size_image}}"/>

                        <x-input type="number" name="{{ __('cms.discount_value') }}" id="discount_value" value="{{$data->discount_value}}"/>


                    <div class="form-group ">
                        <label class="col-12 col-form-label">{{ __('cms.image') }}:</label>
                        <div class="col-9">
                            <div class="image-input image-input-empty image-input-outline" id="kt_image_6"
                                style="background-image: url({{ Storage::url($data->image) }})">
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

                    <div class="row">
                        <x-image id="slider_images_1" col="3" value="{{Storage::url($data->slides?->one )}}"/>
                        <x-image id="slider_images_2" col="3" value="{{Storage::url($data->slides?->two )}}"/>
                        <x-image id="slider_images_3" col="3" value="{{Storage::url($data->slides?->three )}}"/>
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
   
                    
    var slider_images_1 = new KTImageInput('kt_image_slider_images_1');
    var slider_images_2 = new KTImageInput('kt_image_slider_images_2');
    var slider_images_3 = new KTImageInput('kt_image_slider_images_3');
    function performEdit(id){
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
        formData.append('slider_images_1',document.getElementById('slider_images_1').files[0] ? document.getElementById('slider_images_1').files[0] : '');
        formData.append('slider_images_2',document.getElementById('slider_images_2').files[0] ? document.getElementById('slider_images_2').files[0] : '');
        formData.append('slider_images_3',document.getElementById('slider_images_3').files[0] ? document.getElementById('slider_images_3').files[0] : '');
        
        formData.append('option_frame_album_service_id',document.getElementById('option_frame_album_service_id').value);
        formData.append('type',document.getElementById('type').value);
        formData.append('min_size_image', document.getElementById('min_size_image').value);
        formData.append('type_size', document.getElementById('type_size').value);
        formData.append('title_ar',document.getElementById('title_ar').value);
        formData.append('title_en',document.getElementById('title_en').value);
        formData.append('discount_value',document.getElementById('discount_value').value);

        formData.append('note_ar',document.getElementById('note_ar').value);
        formData.append('note_en',document.getElementById('note_en').value);

        formData.append('description_en',document.getElementById('description_en').value);
        formData.append('description_ar',document.getElementById('description_ar').value);
        formData.append('num_photo',document.getElementById('num_photo').value);

        formData.append('image',document.getElementById('image').files[0] ? document.getElementById('image').files[0] : '');
        formData.append('_method','put');

        store('/cms/admin/frames_or_albums/'+id, formData, '/cms/admin/frames_or_albums');
    }
</script>
@endsection