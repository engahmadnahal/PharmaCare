@extends('cms.parent')

@section('page-name',__('cms.specialists'))
@section('main-page',__('cms.hr'))
@section('sub-page',__('cms.specialists'))
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
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.info')}}</h3>
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
                        <label class="col-3 col-form-label">{{__('cms.cities')}}:</label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="city_id"
                                    title="{{__('cms.select_hint')}}" tabindex="null" data-live-search="true">
                                    @foreach ($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}} {{__('cms.city')}}</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.full_name')}}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="full_name"
                                placeholder="{{__('cms.full_name')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.full_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.user_name')}}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="user_name"
                                placeholder="{{__('cms.user_name')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.user_name')}}</span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.contact_information')}}</h3>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.email')}}:</label>
                        <div class="col-9">
                            <input type="email" class="form-control" id="email" placeholder="{{__('cms.email')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.email')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.mobile')}}:</label>
                        <div class="col-9">
                            <input type="tel" class="form-control" id="mobile" placeholder="{{__('cms.mobile')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.mobile')}}</span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.personal_information')}}</h3>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.gender')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="gender"
                                    title="{{__('cms.select_hint')}}" tabindex="null" data-live-search="true">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.gender')}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.birth_date')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <input type="text" class="form-control" readonly="readonly" id="birth_date"
                                placeholder="{{__('cms.birth_date')}}">
                            <span class="form-text text-muted">{{__('cms.please_enter')}}
                                {{__('cms.birth_date')}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.address')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="address" placeholder="{{__('cms.address')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.address')}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.id_card')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="number" class="form-control" id="id_card"
                                placeholder="{{__('cms.id_card')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.id_card')}}</span>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.work_information')}}</h3>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.qualification')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="qualification"
                                    title="{{__('cms.select_hint')}}" tabindex="null" data-live-search="true">
                                    <option value="diploma">Deploma</option>
                                    <option value="bachelor">Bachelor</option>
                                    <option value="master">Master</option>
                                    <option value="doctor">Doctor</option>
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.qualification')}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.experience_years')}}:</label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <input type="number" class="form-control" id="experience_years"
                                placeholder="{{__('cms.experience_years')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}}
                                {{__('cms.experience_years')}}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.practical_bio')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-9">
                            <textarea class="form-control" id="practical_bio" maxlength="150" rows="3"
                                placeholder="{{__('cms.practical_bio')}}"></textarea>
                            <span class="form-text text-muted">{{__('cms.please_enter')}}
                                {{__('cms.practical_bio')}}</span>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.details')}}</h3>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.account_status')}}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" checked="checked" id="status">
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
<script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/js/pages/crud/file-upload/image-input.js')}}"></script>
<script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
<script>
    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }
    $('#birth_date').datepicker({
        rtl: KTUtil.isRTL(),
        orientation: "bottom left",
        todayHighlight: true,
        templates: arrows
    });
    function performStore(){
        let data = {
            role_id: document.getElementById('role_id').value,
            city_id: document.getElementById('city_id').value,
            full_name: document.getElementById('full_name').value,
            user_name: document.getElementById('user_name').value,
            email: document.getElementById('email').value,
            mobile: document.getElementById('mobile').value,
            gender: document.getElementById('gender').value,
            birth_date: document.getElementById('birth_date').value,
            address: document.getElementById('address').value,
            id_card: document.getElementById('id_card').value,
            qualification: document.getElementById('qualification').value,
            experience_years: document.getElementById('experience_years').value,
            practical_bio: document.getElementById('practical_bio').value,
            status: document.getElementById('status').checked,
        }
        store('/cms/admin/specialists',data);
    }
</script>
@endsection