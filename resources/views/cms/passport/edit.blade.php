@extends('cms.parent')

@section('page-name', __('cms.passport'))
@section('main-page', __('cms.services'))
@section('sub-page', __('cms.passport'))
@section('page-name-small', __('cms.update'))

@section('styles')

@endsection

@section('content')
    <!--begin::Container-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{ __('cms.update') }}</h3>
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

                        <div class="form-group row mt-4">
                            <label class="col-3 col-form-label">{{ __('cms.services') }}:<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-4 col-md-9 col-sm-12">
                                <div class="dropdown bootstrap-select form-control dropup">
                                    <select class="form-control selectpicker" data-size="7" id="service_studio_id"
                                        title="Choose one of the following..." tabindex="null" data-live-search="true">
                                        @foreach ($services as $s)
                                            <option value="{{ $s->id }}" @selected($data->service_studio_id == $s->id)>
                                                {{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="form-text text-muted">{{ __('cms.please_select') }}
                                    {{ __('cms.services') }}</span>
                            </div>
                        </div>


                        {{-- <div class="separator separator-dashed my-10"></div> --}}

                        <div class="form-group row mt-4">
                            <label class="col-3 col-form-label">{{ __('cms.title_ar') }}:</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="title_ar"
                                    placeholder="{{ __('cms.title_ar') }}" value="{{ $data->title_ar }}" />
                                <span class="form-text text-muted">{{ __('cms.please_enter') }}
                                    {{ __('cms.title_ar') }}</span>
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <label class="col-3 col-form-label">{{ __('cms.title_en') }}:</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="title_en"
                                    placeholder="{{ __('cms.title_en') }}" value="{{ $data->title_en }}" dir="ltr"/>
                                <span class="form-text text-muted">{{ __('cms.please_enter') }}
                                    {{ __('cms.title_en') }}</span>
                            </div>
                        </div>

                        <x-input type="text" name="{{ __('cms.note') }}" id="note" value="{{ $data->note }}" />
                        <x-input name="{{ __('cms.tax') }}" type="number" id="tax" value="{{ $data->tax }}" />
                        <div class="form-group row">
                            <label class="col-3 col-form-label">{{ __('cms.is_tax') }}</label>
                            <div class="col-3">
                                <span class="switch switch-outline switch-icon switch-success">
                                    <label>
                                        <input type="checkbox" @checked($data->is_tax) id="is_tax">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">{{ __('cms.isNote') }}</label>
                            <div class="col-3">
                                <span class="switch switch-outline switch-icon switch-success">
                                    <label>
                                        <input type="checkbox" @checked($data->isNote) id="isNote">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-3 col-form-label">{{ __('cms.soon') }}</label>
                            <div class="col-3">
                                <span class="switch switch-outline switch-icon switch-success">
                                    <label>
                                        <input type="checkbox" @checked($data->soon) id="soon">
                                        <span></span>
                                    </label>
                                </span>
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



                        <div class="form-group ">
                            <label class="col-12 col-form-label">{{ __('cms.image') }}:</label>
                            <div class="col-9">
                                <div class="image-input image-input-empty image-input-outline" id="kt_image_6"
                                    style="background-image: url({{ Storage::url($data->poster) }})">
                                    <div class="image-input-wrapper"></div>

                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="image" id="image" accept=".png, .jpg, .jpeg">
                                        <input type="hidden" name="image">
                                    </label>

                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="cancel" data-toggle="tooltip" title=""
                                        data-original-title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>

                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="remove" data-toggle="tooltip" title=""
                                        data-original-title="Remove avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <x-image id="slider_images_1" col="3"
                                value="{{ Storage::url($data->slides->one) }}" />
                            <x-image id="slider_images_2" col="3"
                                value="{{ Storage::url($data->slides->two) }}" />
                            <x-image id="slider_images_3" col="3"
                                value="{{ Storage::url($data->slides->three) }}" />
                            <x-image id="slider_images_4" col="3"
                                value="{{ Storage::url($data->slides->foure) }}" />
                        </div>




                        <div class="card-footer">
                            <div class="row">
                                <div class="col-3">

                                </div>
                                <div class="col-9">
                                    <button type="button" onclick="performEdit({{ $data->id }})"
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
        var cover = new KTImageInput('kt_image_6');
        var slider_images_1 = new KTImageInput('kt_image_slider_images_1');
        var slider_images_2 = new KTImageInput('kt_image_slider_images_2');
        var slider_images_3 = new KTImageInput('kt_image_slider_images_3');
        var slider_images_4 = new KTImageInput('kt_image_slider_images_4');

        function performEdit(id) {

            let formData = new FormData();
            // formData.append('discount_value', document.getElementById('discount_value').value);
            formData.append('tax', document.getElementById('tax').value);
            formData.append('is_tax', document.getElementById('is_tax').checked ? 1 : 0);

            formData.append('service_studio_id', document.getElementById('service_studio_id').value);
            formData.append('title_ar', document.getElementById('title_ar').value);
            formData.append('title_en', document.getElementById('title_en').value);
            // formData.append('description_ar',document.getElementById('description_ar').value);
            // formData.append('description_en',document.getElementById('description_en').value);
            formData.append('soon', document.getElementById('soon').checked ? 1 : 0);
            formData.append('active', document.getElementById('active').checked ? 1 : 0);
            formData.append('isNote', document.getElementById('isNote').checked ? 1 : 0);
            formData.append('note', document.getElementById('note').value);
            formData.append('poster', document.getElementById('image').files[0] ? document.getElementById('image').files[
                0] : '');
            formData.append('slider_images_1', document.getElementById('slider_images_1').files[0] ? document
                .getElementById('slider_images_1').files[0] : '');
            formData.append('slider_images_2', document.getElementById('slider_images_2').files[0] ? document
                .getElementById('slider_images_2').files[0] : '');
            formData.append('slider_images_3', document.getElementById('slider_images_3').files[0] ? document
                .getElementById('slider_images_3').files[0] : '');
            formData.append('slider_images_4', document.getElementById('slider_images_4').files[0] ? document
                .getElementById('slider_images_4').files[0] : '');
            formData.append('_method', 'put');

            store('/cms/admin/passport_services/' + id, formData, '/cms/admin/passport_services');
        }
    </script>
@endsection
