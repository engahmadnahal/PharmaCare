@extends('cms.auth.profile.profile')

@section('profile-content')
<div class="flex-row-fluid ml-lg-8">
    <!--begin::Card-->
    <div class="card card-custom card-stretch">
        <!--begin::Header-->
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">{{__('cms.personal_information')}}</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">---</span>
            </div>
            <div class="card-toolbar">
                <button type="button"
                    onclick="performEdit()"
                    class="btn btn-success mr-2">{{__('cms.save')}}</button>
                <button type="reset" class="btn btn-secondary">{{__('cms.cancel')}}</button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form class="form">
            <!--begin::Body-->
            <div class="card-body">
                <div class="row">
                    <label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6">
                        <h5 class="font-weight-bold mb-6">{{__('cms.info')}}</h5>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('cms.name')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <input class="form-control form-control-lg form-control-solid" id="name" type="text"
                            value="{{$user->name}}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('cms.email')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <div class="input-group input-group-lg input-group-solid">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="la la-at"></i>
                                </span>
                            </div>
                            <input type="text" id="email" class="form-control form-control-lg form-control-solid"
                                value="{{$user->email}}" placeholder="Email" />
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </form>
        <!--end::Form-->
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('cms/assets/js/pages/crud/file-upload/image-input.js')}}"></script>

<script>
    var image = new KTImageInput('profile_image');

    function performEdit() {
        let formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('name', document.getElementById('name').value);
        formData.append('email', document.getElementById('email').value);
        store("/portal/profile/personal", formData);


    }
</script>
@endsection