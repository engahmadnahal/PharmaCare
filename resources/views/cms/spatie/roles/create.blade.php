@extends('cms.parent')

@section('page-name',__('cms.roles'))
@section('main-page',__('cms.roles_permissions'))
@section('sub-page',__('cms.roles'))
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
                <h3 class="card-title">{{__('cms.create')}}</h3>
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
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.category')}}:</label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="guard_name"
                                    title="{{__('cms.select_hint')}}" tabindex="null" data-live-search="true">
                                    <option value="admin">Admin</option>
                                    <option value="studio">Studio</option>
                                    <option value="studiobranch">Studio Branch</option>
                                    {{-- <option value="user-api">User App</option> --}}
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}} {{__('cms.category')}}</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.name')}}</label>
                        <div class="col-4">
                            <input type="text" class="form-control" id="name" placeholder="{{__('cms.name')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.name')}}</span>
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
    function performStore(){
        let data = {
            guard_name: document.getElementById('guard_name').value,
            name: document.getElementById('name').value,
        }
        store('/cms/admin/roles', data);
    }
</script>
@endsection