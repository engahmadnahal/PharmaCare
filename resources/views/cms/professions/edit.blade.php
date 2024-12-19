@extends('cms.parent')

@section('page-name',__('cms.professions'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.professions'))
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
            <form>
                <div class="card-body">
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.name')}}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="name" placeholder="{{__('cms.name')}}" value="{{$profession->name}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.info')}}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="info" placeholder="{{__('cms.info')}}" value="{{$profession->info}}"/>
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.info')}}</span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    {{-- <h3 class="text-dark font-weight-bold mb-10">Settings</h3> --}}
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.visible')}}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" checked="checked" id="active" @checked($profession->active)>
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
<script>
    function performEdit(){
        let data = {
            name: document.getElementById('name').value,
            info: document.getElementById('info').value,
            active: document.getElementById('active').checked,
        }
        update('/cms/admin/professions/{{$profession->id}}', data, '/cms/admin/professions');
    }
</script>
@endsection