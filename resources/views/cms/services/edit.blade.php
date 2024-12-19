@extends('cms.parent')

@section('page-name',__('cms.services'))
@section('main-page',__('cms.service_management'))
@section('sub-page',__('cms.services'))
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
                {{-- <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                    </div>
                </div> --}}
            </div>
            <!--begin::Form-->
            <form>
                <div class="card-body">
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.info')}}</h3>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.category')}}:</label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="category_id"
                                    title="{{__('cms.select_hint')}}" tabindex="null" data-live-search="true">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" @if($service->category_id == $category->id)
                                        selected @endif>{{$category->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}} {{__('cms.category')}}</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.name')}} (En):<span
                                class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="name_en" placeholder="{{__('cms.name')}} (En)"
                                value="{{$service->name_en}}" dir="ltr"/>
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.name')}} (Ar):<span
                                class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="name_ar" placeholder="{{__('cms.name')}} (Ar)"
                                value="{{$service->name_ar}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.name')}}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.info')}} (En):<span
                                class="text-danger">*</span></label>
                        <div class="col-9">
                            <textarea class="form-control" id="info_en" maxlength="150" rows="3"
                                placeholder="Enter english info">{{$service->info_en}}</textarea>
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.info')}}</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.info')}} (Ar):<span
                                class="text-danger">*</span></label>
                        <div class="col-9">
                            <textarea class="form-control" id="info_ar" maxlength="150" rows="3"
                                placeholder="Enter arabic info">{{$service->info_ar}}</textarea>
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.info')}}</span>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.details')}}</h3>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.payment_mechanisim')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="payment_mechanism"
                                    title="{{__('cms.select_hint')}}" tabindex="null" data-live-search="true">
                                    <option value="hourly" @if($service->payment_mechanism == 'hourly') selected
                                        @endif>Hourly</option>
                                    <option value="session" @if($service->payment_mechanism == 'session') selected
                                        @endif>Session</option>
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.payment_mechanisim')}}</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.price')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="price" placeholder="{{__('cms.price')}}"
                                value="{{$service->price}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}}
                                {{__('cms.price')}}</span>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.images')}}:</label>
                        <div class="col-3">
                            <div class="image-input image-input-empty image-input-outline" id="service_image_1"
                                style="background-image: url({{Storage::url($service->images[0]->url)}})">
                                <div class="image-input-wrapper"></div>

                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="profile_avatar_remove" />
                                </label>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="image-input image-input-empty image-input-outline" id="service_image_2"
                                style="background-image: url({{Storage::url($service->images[1]->url)}})">
                                <div class="image-input-wrapper"></div>

                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="profile_avatar_remove" />
                                </label>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="image-input image-input-empty image-input-outline" id="service_image_3"
                                style="background-image: url({{Storage::url($service->images[2]->url)}})">
                                <div class="image-input-wrapper"></div>

                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="profile_avatar_remove" />
                                </label>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.settings')}}</h3>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.visible')}}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" @if($service->active) checked="checked" @endif
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
                            <button type="button" onclick="performEdit()"
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
<script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/js/pages/crud/file-upload/image-input.js')}}"></script>
<script>
    var image1 = new KTImageInput('service_image_1');
    var image2 = new KTImageInput('service_image_2');
    var image3 = new KTImageInput('service_image_3');
    function performEdit(){
        let formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('category_id',document.getElementById('category_id').value);
        formData.append('name_en',document.getElementById('name_en').value);
        formData.append('name_ar',document.getElementById('name_ar').value);
        formData.append('info_en',document.getElementById('info_en').value);
        formData.append('info_ar',document.getElementById('info_ar').value);
        formData.append('price',document.getElementById('price').value);
        formData.append('payment_mechanism',document.getElementById('payment_mechanism').value);
        if(image1.input.files[0] != undefined){
            formData.append('image_1',image1.input.files[0]);
        }
        if(image2.input.files[0] != undefined){
            formData.append('image_2',image2.input.files[0]);
        }
        if(image3.input.files[0] != undefined){
            formData.append('image_3',image3.input.files[0]);
        }
        formData.append('active',document.getElementById('active').checked);
        store('/cms/admin/services/{{$service->id}}', formData, '/cms/admin/services');
    }
</script>
@endsection