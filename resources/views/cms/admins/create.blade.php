@extends('cms.parent')

@section('page-name',__('cms.admins'))
@section('main-page',__('cms.hr'))
@section('sub-page',__('cms.admins'))
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
                                    title="{{__('cms.select_hint')}}" tabindex="null" data-live-search="true">
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}} {{__('cms.role')}}</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.full_name')}}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="name" placeholder="{{__('cms.full_name')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.full_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.mobile')}}:</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="mobile"
                                placeholder="{{__('cms.mobile')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.mobile')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.email')}}:</label>
                        <div class="col-9">
                            <input type="email" class="form-control" id="email" placeholder="{{__('cms.email')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.email')}}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.address')}}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="address"
                                placeholder="{{__('cms.address')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.address')}}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.national_id')}}:</label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="national_id"
                                placeholder="{{__('cms.national_id')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.national_id')}}</span>
                        </div>
                    </div>


                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.password')}}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="password"
                                placeholder="{{__('cms.password')}}" />
                            <span class="form-text text-muted">{{__('cms.password')}} {{__('cms.password')}}</span>
                        </div>
                    </div>


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
                        <label class="col-3 col-form-label">{{__('cms.account_status')}}</label>
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
        formData.append('name',document.getElementById('name').value);
        formData.append('email',document.getElementById('email').value);
        formData.append('role_id',document.getElementById('role_id').value);
        formData.append('address',document.getElementById('address').value);
        formData.append('mobile',document.getElementById('mobile').value);
        formData.append('password',document.getElementById('password').value);
        formData.append('national_id',document.getElementById('national_id').value);
        formData.append('avater',document.getElementById('image').files[0]);
        formData.append('active',document.getElementById('active').checked);
        store('/cms/admin/admins',formData);
    }
</script>
@endsection