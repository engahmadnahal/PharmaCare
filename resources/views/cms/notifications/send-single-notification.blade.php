@extends('cms.parent')

@section('page-name',__('cms.notifications_FCM'))
@section('main-page',__('cms.notifications'))
@section('sub-page',__('cms.notifications_FCM'))
@section('page-name-small',__('cms.notifications_FCM'))

@section('styles')

@endsection

@section('content')
<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{__('cms.notifications_FCM')}}</h3>
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
                    <h3 class="text-dark font-weight-bold mb-10">Basic Info</h3>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Users:</label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="user_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    <option value="0">{{__('cms.all')}}</option>
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">Please select user</span>
                        </div>
                    </div>
                    <x-input type="text" name="{{ __('cms.title_ar') }}" id="title_ar" />
                    <x-textarea type="text" name="{{ __('cms.body_ar') }}" id="body_ar" />

                    <x-input type="text" name="{{ __('cms.title_en') }}" id="title_en" dir="ltr"/>
                    <x-textarea type="text" name="{{ __('cms.body_en') }}" id="body_en" dir="ltr"/>

                   
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="performStore()" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
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
<script src="{{asset('cms/assets/js/pages/crud/forms/widgets/bootstrap-select.js')}}"></script>
<script src="{{asset('cms/assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>

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
    $('#send_date').datepicker({
        rtl: KTUtil.isRTL(),
        orientation: "bottom left",
        todayHighlight: true,
        templates: arrows
    });

    function performStore(){
        let data = {
            user_id: document.getElementById('user_id').value,
            title_ar: document.getElementById('title_ar').value,
            body_ar: document.getElementById('body_ar').value,
            title_en: document.getElementById('title_en').value,
            body_en: document.getElementById('body_en').value,
        }
        store('/cms/admin/notification_fcm_users',data);
    }
</script>
@endsection