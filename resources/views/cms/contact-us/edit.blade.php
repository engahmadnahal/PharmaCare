@extends('cms.parent')

@section('page-name',__('cms.contact_us_message'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.contact_us_message'))
@section('page-name-small',__('cms.update'))

@section('styles')

@endsection

@section('content')


<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Card body-->
            <div class="card-body">
                <form class="form" id="kt_form">
                    <div class="tab-content">
                        <!--begin::Tab-->
                        <div class="tab-pane show px-7 active" id="kt_user_edit_tab_1" role="tabpanel">
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-7 my-2">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <label class="col-3"></label>
                                        <div class="col-9">
                                            <h6 class="text-dark font-weight-bold mb-10">{{__('cms.messsage_info')}}:
                                            </h6>
                                        </div>
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label
                                            class="col-form-label col-3 text-lg-right text-left">{{__('cms.image')}}</label>
                                        <div class="col-9">
                                            <div class="image-input image-input-empty image-input-outline"
                                                id="kt_user_edit_avatar"
                                                style="background-image: url(assets/media/users/blank.png)">
                                                <div class="image-input-wrapper"></div>
                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="cancel" data-toggle="tooltip" title=""
                                                    data-original-title="Cancel avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                                <span
                                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                    data-action="remove" data-toggle="tooltip" title=""
                                                    data-original-title="Remove avatar">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label
                                            class="col-form-label col-3 text-lg-right text-left">{{__('cms.name')}}</label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid" type="text"
                                                value="{{$contact_us->user->first_name??'-'}} {{$contact_us->user->last_name??'-'}}"
                                                disabled>
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label
                                            class="col-form-label col-3 text-lg-right text-left">{{__('cms.email')}}</label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid" type="text"
                                                value="{{$contact_us->user->email ??'-'}}" disabled>
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                    <div class="separator separator-dashed my-10"></div>
                                    <div class="form-group row mt-4">
                                        <label class="col-3 col-form-label">{{__('cms.message')}}:<span
                                                class="text-danger"></span></label>
                                        <div class="col-9">
                                            <textarea class="form-control" id="message" maxlength="1000" rows="3"
                                                placeholder="{{__('cms.please_enter')}} {{__('cms.message')}}"
                                                disabled>{{$contact_us->message}}</textarea>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed my-10"></div>
                                    <div class="form-group row">
                                        <label
                                            class="col-form-label col-3 text-lg-right text-left">{{__('cms.status')}}</label>
                                        <div class="col-9">
                                            <div class="checkbox-inline mb-2">
                                                <label class="checkbox">
                                                    <input type="checkbox" disabled @if ($contact_us->status=='Wating')
                                                    checked
                                                    @endif>
                                                    <span></span>{{__('cms.waiting')}}</label>
                                            </div>
                                            <div class="checkbox-inline mb-2">
                                                <label class="checkbox">
                                                    <input type="checkbox" @if ($contact_us->status=='Done')
                                                    checked
                                                    @endif disabled>
                                                    <span></span>{{__('cms.done')}}</label>
                                            </div>
                                        </div>

                                    </div>
                                    <!--end::Group-->
                                    <div class="separator separator-dashed my-10"></div>
                                    <div class="form-group row mt-4">
                                        <label class="col-3 col-form-label">{{__('response')}}:<span
                                                class="text-danger"></span></label>
                                        <div class="col-9">
                                            <textarea class="form-control" id="response" maxlength="1000" rows="3"
                                                placeholder="{{__('cms.please_enter')}} {{__('cms.response')}}"></textarea>
                                            <span class="form-text text-muted">{{__('cms.please_enter')}}
                                                {{__('cms.response')}}</span>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed my-10"></div>
                                </div>

                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Tab-->
                    </div>
                </form>
            </div>
            <!--begin::Card body-->
            <div class="card-footer">
                <div class="row">
                    <div class="col-3">

                    </div>
                    <div class="col-9">
                        <button type="button" onclick="performEdit('{{$contact_us->id}}')"
                            class="btn btn-primary mr-2">{{__('cms.save')}}</button>
                        <button type="reset" class="btn btn-secondary">{{__('cms.cancel')}}</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>


@endsection

@section('scripts')
<script>
    function performEdit(id){
        let data = {
            response: document.getElementById('response').value,
        }
        update('/cms/admin/contact_us/'+id, data, '/cms/admin/contact_us');
    }
</script>
@endsection