@extends('cms.parent')

@section('page-name',__('cms.passport'))
@section('main-page',__('cms.services'))
@section('sub-page',__('cms.passport'))
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
                        <label class="col-3 col-form-label">{{__('cms.passport')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="passport_service_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($passport as $c)
                                    <option value="{{$c->id}}" @selected($c->id == $data->passport_service_id)>{{$c->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.passport')}}</span>
                        </div>
                    </div>


                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.countries')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="country_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($countries as $c)
                                    <option value="{{$c->id}}" @selected($data->passport_country_id == $c->id)>{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.countries')}}</span>
                        </div>
                    </div>


                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.type')}}:<span
                                class="text-danger">*</span></label>
                
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="type"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($passportType as $type)
                                        <option value="{{$type->id}}" @selected($type->id == $data->passport_type_id)>{{$type->title}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.type')}}</span>
                        </div>
                    </div>

                    <x-input type="text" name="{{ __('cms.note') }}" id="note" value="{{$data->note}}"/>
                    <x-input type="text" name="{{ __('cms.note_en') }}" id="note_en" value="{{$data->note_en}}"/>


                        <div class="form-group row">
                            <label class="col-3 col-form-label">{{ __('cms.isNote') }}</label>
                            <div class="col-3">
                                <span class="switch switch-outline switch-icon switch-success">
                                    <label>
                                        <input type="checkbox" @checked($data->isNote) id="isNote">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                    
                <div class="separator separator-dashed my-10"></div>

                <x-input type="text" name="{{ __('cms.title_ar') }}" id="title_ar" value="{{$data->title_ar}}"/>
                <x-input type="text" name="{{ __('cms.title_en') }}" id="title_en" value="{{$data->title_en}}" dir="ltr"/>


                    <x-textarea name="{{ __('cms.condition_ar') }}" id="description_ar" value="{{$data->description_ar}}"/>
                    <x-textarea name="{{ __('cms.condition_en') }}" id="description_en" value="{{$data->description_en}}" dir="ltr"/>



                    <x-input type="text" name="{{ __('cms.num_photo') }}" id="num_photo" value="{{$data->num_photo}}"/>
                        @foreach ($currency as $crr)
                            <x-input type="text" name="{{ __('cms.price') }} / {{$crr->name}}" id="photo_price_{{$crr->id}}" value="{{$data->price->where('currency_id',$crr->id)->first()?->price}}"/>
                            <x-input type="text" name="{{ __('cms.price_elm') }} / {{$crr->name}}" id="price_after_increse_{{$crr->id}}" value="{{$data->priceAfterIncres->where('currency_id',$crr->id)->first()?->price}}"/>
                        @endforeach

                    <x-input type="text" name="{{ __('cms.num_add') }}" id="num_add" value="{{$data->num_add}}"/>
                    {{-- <x-input type="number" name="{{ __('cms.discount_value') }}" id="discount_value" value="{{$data->discount_value}}"/> --}}

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
                    <x-input type="text" name="{{ __('cms.min_size_image') }} " id="min_size_image" value="{{$data->min_size_image}}"/>


                        <div class="form-group ">
                            <label class="col-12 col-form-label">{{ __('cms.example') }}:</label>
                            <div class="col-9">
                                <div class="image-input image-input-empty image-input-outline" id="kt_image_6"
                                    style="background-image: url({{ Storage::url($data->image) }})">
                                    <div class="image-input-wrapper"></div>

                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="image" id="image" accept=".png, .jpg, .jpeg">
                                        <input type="hidden" name="image">
                                    </label>

                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="cancel" data-toggle="tooltip" title=""
                                        data-original-title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>

                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="remove" data-toggle="tooltip" title=""
                                        data-original-title="Remove avatar">
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
                                <button type="button" onclick="performEdit({{$data->id}})"
                                    class="btn btn-primary mr-2">{{ __('cms.save') }}</button>
                                <button type="reset" class="btn btn-secondary">{{ __('cms.cancel') }}</button>
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
            formData.append('image',document.getElementById('image').files[0] ? document.getElementById('image').files[0] : '');
            formData.append('min_size_image',document.getElementById('min_size_image').value);
            formData.append('type_size',document.getElementById('type_size').value);
            formData.append('isNote',document.getElementById('isNote').checked ? 1 : 0);
            formData.append('note',document.getElementById('note').value);
            formData.append('note_en',document.getElementById('note_en').value);
            formData.append('title_en',document.getElementById('title_en').value);
            formData.append('title_ar',document.getElementById('title_ar').value);
            formData.append('passport_service_id',document.getElementById('passport_service_id').value);
            formData.append('country_id',document.getElementById('country_id').value);
            formData.append('type',document.getElementById('type').value);
            formData.append('description_ar',document.getElementById('description_ar').value);
            formData.append('description_en',document.getElementById('description_en').value);
            formData.append('num_add',document.getElementById('num_add').value);
            formData.append('num_photo',document.getElementById('num_photo').value);
            @foreach ($currency as $crr)
                    formData.append('photo_price[{{$loop->index}}][currncyId]',{{$crr->id}});
                    formData.append('photo_price[{{$loop->index}}][value]',document.getElementById('photo_price_{{$crr->id}}').value);
            @endforeach
            @foreach ($currency as $crr)
                formData.append('price_after_increse[{{$loop->index}}][currncyId]',{{$crr->id}});
                    formData.append('price_after_increse[{{$loop->index}}][value]',document.getElementById('price_after_increse_{{$crr->id}}').value);
            @endforeach

            formData.append('_method','put');

        store('/cms/admin/passport_options/'+id, formData, '/cms/admin/passport_options');
    }
</script>
@endsection