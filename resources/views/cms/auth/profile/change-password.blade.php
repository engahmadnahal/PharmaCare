@extends('cms.auth.profile.profile')

@section('profile-content')
<!--begin::Content-->
<div class="flex-row-fluid ml-lg-8">
    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">{{__('cms.change_password')}}</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">---</span>
            </div>
            <div class="card-toolbar">
                <button type="button" onclick="performStore()" class="btn btn-success mr-2">{{__('cms.save')}}</button>
                <button type="reset" class="btn btn-secondary">{{__('cms.cancel')}}</button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form class="form" id="create-form">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{__('cms.current_password')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <input type="password" class="form-control form-control-lg form-control-solid mb-2"
                            id="current_password" value="" placeholder="{{__('cms.current_password')}}" />
                        {{-- <a href="#" class="text-sm font-weight-bold">Forgot password ?</a> --}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{__('cms.new_password')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <input type="password" class="form-control form-control-lg form-control-solid" value=""
                            id="new_password" placeholder="{{__('cms.new_password')}}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{__('cms.confirm_password')}}</label>
                    <div class="col-lg-9 col-xl-6">
                        <input type="password" class="form-control form-control-lg form-control-solid" value=""
                            id="new_password_confirmation" placeholder="{{__('cms.confirm_password')}}" />
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>
<!--end::Content-->
@endsection

@section('scripts')
@parent
<script>
    function performStore(){
        let data = {
            current_password: document.getElementById('current_password').value,
            new_password: document.getElementById('new_password').value,
            new_password_confirmation: document.getElementById('new_password_confirmation').value,
        }
        store('/cms/admin/change-password',data);
    }
</script>
@endsection