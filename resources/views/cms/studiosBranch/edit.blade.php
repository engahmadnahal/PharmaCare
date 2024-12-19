@extends('cms.parent')

@section('page-name',__('cms.sub_branch'))
@section('main-page',__('cms.hr'))
@section('sub-page',__('cms.sub_branch'))
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
                        <label class="col-3 col-form-label">{{__('cms.role')}}:</label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="role_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}" @if (!is_null($assignedRole) && $assignedRole->id ==
                                        $role->id) selected
                                        @endif>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}} {{__('cms.role')}}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.cities')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="city_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($cities as $c)
                                    <option value="{{$c->id}}" @selected($c->id == $studio->city_id)>{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.cities')}}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.regions')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="region_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($region as $c)
                                    <option value="{{$c->id}}" @selected($c->id == $studio->region_id)>{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.regions')}}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.type')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="type"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    <option value="main" @selected($studio->type == 'main')>{{__('cms.main_branch')}}</option>
                                    <option value="branch" @selected($studio->type == 'branch')>{{__('cms.branches')}}</option>
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.type')}}</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.full_name')}}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="name" placeholder="{{__('cms.full_name')}}" value="{{$studio->name}}"/>
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.full_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.mobile')}}:</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="mobile"
                                placeholder="{{__('cms.mobile')}}" value="{{$studio->mobile}}"/>
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.mobile')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.email')}}:</label>
                        <div class="col-9">
                            <input type="email" class="form-control" id="email" placeholder="{{__('cms.email')}}" value="{{$studio->email}}"/>
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.email')}}</span>
                        </div>
                    </div>

                    <x-textarea name="{{__('cms.description_ar')}}" id="description_ar" value="{{$studio->description_ar}}"/>
                    <x-textarea name="{{__('cms.description_en')}}" id="description_en" value="{{$studio->description_en}}" dir="ltr"/>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.address')}}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="address"
                                placeholder="{{__('cms.address')}}" value="{{$studio->address}}"/>
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.address')}}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.latitude')}}:</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="latitude"
                                placeholder="{{__('cms.latitude')}}" value="{{$studio->latidute}}"/>
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.latitude')}}</span>
                        </div>
                    </div>
                    
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.longitude')}}:</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="longitude"
                                placeholder="{{__('cms.longitude')}}" value="{{$studio->longitude}}"/>
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.longitude')}}</span>
                        </div>
                    </div>

                 


                    @can('OrderList-StudioBranch')
                        <div class="form-group row mt-4">
                            <label class="col-3 col-form-label">{{__('cms.position')}}:</label>
                            <div class="col-9">
                                <input type="number" class="form-control" id="orderd"
                                placeholder="{{__('cms.position')}}" value="{{$studio->orderd}}"/>
                                <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.position')}}</span>
                            </div>
                        </div>
                    @endcan

                    <div class="form-group ">
                        <label class="col-12 col-form-label">{{ __('cms.image') }}:</label>
                        <div class="col-9">
                            <div class="image-input image-input-empty image-input-outline" id="kt_image_6"
                                style="background-image: url({{ Storage::url($studio->avater) }})">
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
                        <x-image id="slider_images_1" col="3" value="{{Storage::url($studio->slides->one ?? '')}}"/>
                        <x-image id="slider_images_2" col="3" value="{{Storage::url($studio->slides->two ?? '')}}"/>
                        <x-image id="slider_images_3" col="3" value="{{Storage::url($studio->slides->three ?? '')}}"/>
                        <x-image id="slider_images_4" col="3" value="{{Storage::url($studio->slides->foure ?? '')}}"/>
                    </div>





                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.is_lawful_service')}}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" @checked($studio->is_lawful_service) id="is_lawful_service">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>




                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.account_status')}}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" @checked($studio->active)
                                    id="active">
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
                            <button type="button" onclick="performEdit('{{$studio->id}}')"
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
    var slider_images_4 = new KTImageInput('kt_image_slider_images_4');
    
    function performEdit(id){
        let formData = new FormData();
        @can('OrderList-StudioBranch')
            formData.append('orderd',document.getElementById('orderd').value);
        @endcan
        formData.append('description_en',document.getElementById('description_en').value);
        formData.append('description_ar',document.getElementById('description_ar').value);
        formData.append('name',document.getElementById('name').value);
        formData.append('email',document.getElementById('email').value);
        formData.append('role_id',document.getElementById('role_id').value);
        formData.append('city_id',document.getElementById('city_id').value);
        formData.append('region_id',document.getElementById('region_id').value);
        formData.append('type',document.getElementById('type').value);
        formData.append('address',document.getElementById('address').value);
        formData.append('mobile',document.getElementById('mobile').value);
        formData.append('longitude',document.getElementById('longitude').value);
        formData.append('latitude',document.getElementById('latitude').value);
        formData.append('avater',document.getElementById('image').files[0]? document.getElementById('image').files[0] : '');
        formData.append('active',document.getElementById('active').checked?1:0);
        formData.append('is_lawful_service',document.getElementById('is_lawful_service').checked?1:0);
        formData.append('slider_images_1',document.getElementById('slider_images_1').files[0] ? document.getElementById('slider_images_1').files[0] : '');
        formData.append('slider_images_2',document.getElementById('slider_images_2').files[0] ? document.getElementById('slider_images_2').files[0] : '');
        formData.append('slider_images_3',document.getElementById('slider_images_3').files[0] ? document.getElementById('slider_images_3').files[0] : '');
        formData.append('slider_images_4',document.getElementById('slider_images_4').files[0] ? document.getElementById('slider_images_4').files[0] : '');
        formData.append('_method','put');

        store('/cms/admin/studio_branches/'+id, formData, '/cms/admin/studio_branches');
    }
</script>
@endsection