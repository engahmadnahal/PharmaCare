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
               
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.size_or_type')}}:<span
                                class="text-danger">*</span></label>

                                
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="packge_poster_service_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($optionPoster as $s)
                                        <option value="{{$s->id}}" @selected($s->id == $data->packge_poster_service_id)>{{$s->title}}</option>
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
                                                <option value="print" @selected($data->type == 'print')>{{__('cms.print_section')}}</option>
                                                <option value="frame" @selected($data->type == 'frame')>{{__('cms.frame_section')}}</option>
                                                <option value="printColor" @selected($data->type == 'printColor')>{{__('cms.printColor_section')}}</option>
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">{{__('cms.please_select')}}
                                        {{__('cms.type')}}</span>
                                </div>
                    </div>


                    <div class="separator separator-dashed my-10"></div>
                   

                    <x-textarea name="{{__('cms.description_ar')}}" id="description_ar" value="{{$data->description_ar}}"/>
                    <x-textarea name="{{__('cms.description_en')}}" id="description_en" value="{{$data->description_en}} " dir="ltr"/>

                        @foreach ($currency as $crr)
                        <x-input type="text" name="{{ __('cms.price') }} {{$crr->name}}" id="price_{{$crr->id}}" value="{{$data->price->where('currency_id',$crr->id)->first()?->price}}"/>
                    @endforeach

                    


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

                   
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.isPrice')}}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" @checked($data->isPrice) id="isPrice">
                                    <span></span>
                                </label>
                            </span>
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
        let currences = [
                @foreach ($currency as $crr)
                {
                    currncyId : {{$crr->id}},
                    value : document.getElementById('price_{{$crr->id}}').value,
                },
                @endforeach
            ];
        formData.append('price', JSON.stringify(currences));
        formData.append('type',document.getElementById('type').value);
        formData.append('packge_poster_service_id',document.getElementById('packge_poster_service_id').value);
        formData.append('description_en',document.getElementById('description_en').value);
        formData.append('description_ar',document.getElementById('description_ar').value);
        formData.append('isPrice',document.getElementById('isPrice').checked ? 1 : 0);
        formData.append('image',document.getElementById('image').files[0] ? document.getElementById('image').files[0] : '');
        formData.append('_method','put');

        store('/cms/admin/sub_option_posterprint_services/'+id, formData, '/cms/admin/sub_option_posterprint_services');
    }
</script>
@endsection