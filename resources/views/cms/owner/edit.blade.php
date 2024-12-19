@extends('cms.parent')

@section('page-name', __('cms.admins'))
@section('main-page', __('cms.hr'))
@section('sub-page', __('cms.admins'))
@section('page-name-small', __('cms.update'))

@section('styles')

@endsection

@section('content')
    <!--begin::Container-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ __('cms.update') }}</h3>
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
                            <label class="col-3 col-form-label">{{__('cms.roles')}}:<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-4 col-md-9 col-sm-12">
                                <div class="dropdown bootstrap-select form-control dropup">
                                    <select class="form-control selectpicker" data-size="7" id="role_id"
                                        title="Choose one of the following..." tabindex="null" data-live-search="true">
                                        @foreach ($roles as $role)
                                        <option value="{{$role->id}}" @selected(!is_null($assignedRole) && $assignedRole->id ==
                                            $role->id)>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="form-text text-muted">{{__('cms.please_select')}}
                                    {{__('cms.roles')}}</span>
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
                                        <option value="{{$c->id}}" @selected($data->country_id == $c->id)>{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="form-text text-muted">{{__('cms.please_select')}}
                                    {{__('cms.countries')}}</span>
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
                                        <option value="{{$c->id}}" @selected($data->city_id == $c->id)>{{$c->name}}</option>
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
                                        @foreach ($regions as $r)
                                        <option value="{{$r->id}}" @selected($data->region_id == $r->id)>{{$r->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="form-text text-muted">{{__('cms.please_select')}}
                                    {{__('cms.regions')}}</span>
                            </div>
                        </div>
            
                        <x-input type="text" name="{{__('cms.fname')}}" id="fname" value="{{$data->fname}}"/>
                        <x-input type="text" name="{{__('cms.lname')}}" id="lname" value="{{$data->lname}}"/>
                        <x-input type="text" name="{{__('cms.address')}}" id="address" value="{{$data->address}}"/>
                        <x-input type="text" name="{{__('cms.mobile')}}" id="mobile" value="{{$data->mobile}}"/>
                        <x-input type="text" name="{{__('cms.national_id')}}" id="national_id" value="{{$data->national_id}}"/>
                        <x-input type="text" name="{{__('cms.email')}}" id="email" value="{{$data->email}}"/>
                            <x-input type="text" name="{{__('cms.password')}}" id="password" />

                        <div class="form-group ">
                            <label class="col-12 col-form-label">{{ __('cms.image') }}:</label>
                            <div class="col-9">
                                <div class="image-input image-input-empty image-input-outline" id="kt_image_6"
                                    style="background-image: url({{ Storage::url($data->avater) }})">
                                    <div class="image-input-wrapper"></div>

                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="avater" id="avater" accept=".png, .jpg, .jpeg">
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

                        <div class="form-group row">
                            <label class="col-3 col-form-label">{{__('cms.account_status')}}</label>
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
                                <button type="button" onclick="performEdit('{{ $data->id }}')"
                                    class="btn btn-primary mr-2">{{ __('cms.update') }}</button>
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


        function performEdit(id) {
            let formData = new FormData();
            formData.append('country_id',document.getElementById('country_id').value);
            formData.append('city_id',document.getElementById('city_id').value);
            formData.append('region_id',document.getElementById('region_id').value);
            formData.append('fname',document.getElementById('fname').value);
            formData.append('lname',document.getElementById('lname').value);
            formData.append('email',document.getElementById('email').value);
            formData.append('password',document.getElementById('password').value);
            formData.append('mobile',document.getElementById('mobile').value);
            formData.append('national_id',document.getElementById('national_id').value);
            formData.append('role_id',document.getElementById('role_id').value);
            formData.append('address',document.getElementById('address').value);
            formData.append('avater',document.getElementById('avater').files[0] ? document.getElementById('avater').files[0] : '');
            formData.append('active',document.getElementById('active').checked?1:0);
            formData.append('_method', 'put');
            store('/cms/admin/owner_studios/' + id, formData, '/cms/admin/owner_studios');
        }
    </script>
@endsection
