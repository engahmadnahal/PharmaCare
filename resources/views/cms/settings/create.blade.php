@extends('cms.parent')

@section('page-name',__('cms.settings'))
@section('main-page',__('cms.settings'))
@section('sub-page',__('cms.settings'))
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
                <h3 class="card-title">{{__('cms.settings')}}</h3>
            </div>
            <!--begin::Form-->
            <form id="settings_form">
                <div class="card-body">
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.tax')}}:</label>
                        <div class="col-9">
                            <input type="tel" id="tax" class="form-control" value="{{$data?->tax}}"
                                placeholder="Enter tax" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.is_tax')}}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" @checked($data?->is_tax) id="is_tax">
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
    function performStore(){
        let data = {
            is_tax : document.getElementById('is_tax').checked,
            tax : $('#tax').val()
        };
        store('/cms/admin/settings',data);
    }
</script>
@endsection