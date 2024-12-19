@extends('cms.parent')

@section('page-name', __('cms.passport'))
@section('main-page', __('cms.services'))
@section('sub-page', __('cms.passport'))
@section('page-name-small', __('cms.create'))

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
                </div>
                <!--begin::Form-->
                <form id="create-form">
                    <div class="card-body">


                        <div class="form-group row mt-4">
                            <label class="col-3 col-form-label">{{ __('cms.name_ar') }}:</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="name_ar"
                                    placeholder="{{ __('cms.name_ar') }}" />
                                <span class="form-text text-muted">{{ __('cms.please_enter') }}
                                    {{ __('cms.name_ar') }}</span>
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <label class="col-3 col-form-label">{{ __('cms.name_en') }}:</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="name_en"
                                    placeholder="{{ __('cms.name_en') }}" />
                                <span class="form-text text-muted">{{ __('cms.please_enter') }}
                                    {{ __('cms.name_en') }}</span>
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <label class="col-3 col-form-label">{{ __('cms.code') }}:</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="code"
                                    placeholder="{{ __('cms.code') }}" />
                                <span class="form-text text-muted">{{ __('cms.please_enter') }}
                                    {{ __('cms.code') }}</span>
                            </div>
                        </div>




                        <div class="card-footer">
                            <div class="row">
                                <div class="col-3">

                                </div>
                                <div class="col-9">
                                    <button type="button" onclick="performStore()"
                                        class="btn btn-primary mr-2">{{ __('cms.save') }}</button>
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

        function performStore() {
            let formData = new FormData();
            formData.append('name_ar', document.getElementById('name_ar').value);
            formData.append('name_en', document.getElementById('name_en').value);
            formData.append('code', document.getElementById('code').value);
            store('/cms/admin/currencies', formData);
        }
    </script>
@endsection
