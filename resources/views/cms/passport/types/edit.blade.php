@extends('cms.parent')

@section('page-name',__('cms.passport'))
@section('main-page',__('cms.services'))
@section('sub-page',__('cms.passport'))
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
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">


                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{ __('cms.title_ar') }}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="title_ar"
                                placeholder="{{ __('cms.title_ar') }}" value="{{$data->title_ar}}"/>
                            <span class="form-text text-muted">{{ __('cms.please_enter') }}
                                {{ __('cms.title_ar') }}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{ __('cms.title_en') }}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="title_en"
                                placeholder="{{ __('cms.title_en') }}" value="{{$data->title_en}}" dir="ltr"/>
                            <span class="form-text text-muted">{{ __('cms.please_enter') }}
                                {{ __('cms.title_en') }}</span>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('cms.status') }}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" @checked($data->active) id="active">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>


                    <div class="card-footer">
                        <div class="row">
                            <div class="col-3">

                            </div>
                            <div class="col-9">
                                <button type="button" onclick="performEdit({{$data->id}})"
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
  
    function performEdit(id){

        let formData = new FormData();
        formData.append('title_ar',document.getElementById('title_ar').value);
        formData.append('title_en',document.getElementById('title_en').value);
        formData.append('active',document.getElementById('active').checked?1:0);
        formData.append('_method','put');

        store('/cms/admin/passport_types/'+id, formData, '/cms/admin/passport_types');
    }
</script>
@endsection