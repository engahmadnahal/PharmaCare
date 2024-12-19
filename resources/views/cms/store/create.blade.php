@extends('cms.parent')

@section('page-name', __('cms.store'))
@section('main-page', __('cms.content_management'))
@section('sub-page', __('cms.store'))
@section('page-name-small', __('cms.create'))

@section('styles')

@endsection

@section('content')
<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">
        {{-- {{dd(isset($data['country']));}} --}}
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">
                    @empty($store)
                    {{ __('cms.create') }}
                    @else
                    {{ __('cms.add_trans') }}
                    @endempty
                </h3>
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
                        <label class="col-3 col-form-label">{{ __('cms.language') }}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="language"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{ __('cms.please_select') }}
                                {{ __('cms.type') }}</span>
                        </div>
                    </div>





                    @empty($store)


                    <div class="separator separator-dashed my-10"></div>
                    <x-input id="name" type="text" name="{{ __('cms.name') }}" />
                    <x-input id="mobile" type="text" name="{{ __('cms.mobile') }}" />
                    <x-input id="email" type="text" name="{{ __('cms.email') }}" />
                    {{--
                    <x-input id="password" type="text" name="{{ __('cms.password') }}" /> --}}
                    <x-input id="longitude" type="text" name="{{ __('cms.longitude') }}" />
                    <x-input id="latitude" type="text" name="{{ __('cms.latitude') }}" />
                    <x-input id="address" type="text" name="{{ __('cms.address') }}" />

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{ __('cms.regions') }}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="region"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    {{-- @foreach ($regions as $r)
                                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <span class="form-text text-muted">{{ __('cms.please_select') }}
                                {{ __('cms.regions') }}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{ __('cms.store-category') }}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="category"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    {{-- @foreach ($category as $c)
                                    <option value="{{ $c->id }}">{{ $c->title }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <span class="form-text text-muted">{{ __('cms.please_select') }}
                                {{ __('cms.store-category') }}</span>
                        </div>
                    </div>




                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{ __('cms.settings') }}</h3>


                    <x-input id="note" type="text" name="{{ __('cms.notes') }}" />

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{ __('cms.type-store') }}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="type"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    <option value="main_branch">{{ __('cms.main_branch') }}</option>
                                    <option value="sub_branch">{{ __('cms.sub_branch') }}</option>
                                    <option value="normal">{{ __('cms.normal') }}</option>
                                </select>
                            </div>
                            <span class="form-text text-muted">{{ __('cms.please_select') }}
                                {{ __('cms.type-store') }}</span>
                        </div>
                    </div>





                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('cms.delivery') }}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" checked="checked" id="delivery">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{ __('cms.active') }}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" checked="checked" id="active">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">

                <div class="form-group col-6">
                    <label class="col-3 col-form-label">{{ __('cms.image') }}:</label>
                    <div class="col-9">
                        <div class="image-input image-input-empty image-input-outline" id="kt_image_5"
                            style="background-image: url({{ asset('assets/media/users/blank.png') }})">
                            <div class="image-input-wrapper"></div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="logo" id="logo" accept=".png, .jpg, .jpeg">
                                <input type="hidden" name="profile_avatar_remove">
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <label class="col-12 col-form-label">{{ __('cms.cover_image') }}:</label>
                    <div class="col-9">
                        <div class="image-input image-input-empty image-input-outline" id="kt_image_6"
                            style="background-image: url({{ asset('assets/media/users/blank.png') }})">
                            <div class="image-input-wrapper"></div>

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="logo" id="cover" accept=".png, .jpg, .jpeg">
                                <input type="hidden" name="cover">
                            </label>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>

                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove avatar">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

                @else
                <x-input id="name" type="text" name="{{ __('cms.name') }}" />
                <x-input id="address" type="text" name="{{ __('cms.address') }}" />
                <x-input id="note" type="text" name="{{ __('cms.notes') }}" />
                @endempty

                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="performStore({{ $store->id ?? null }})"
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
@empty($store)
<script>
    var image = new KTImageInput('kt_image_5');
    var cover = new KTImageInput('kt_image_6');
        controlFormInputs(true);
        $('#language').on('change', function() {
            $('#category').html('');
            $('#region').html('');
            getDataForLang(this.value);
            controlFormInputs(this.value == -1);
        });

        function controlFormInputs(disabled) {
            $('#name').attr('disabled', disabled);
            $('#mobile').attr('disabled', disabled);
            $('#email').attr('disabled', disabled);
            // $('#password').attr('disabled', disabled);
            $('#longitude').attr('disabled', disabled);
            $('#latitude').attr('disabled', disabled);
            $('#address').attr('disabled', disabled);
            $('#region').attr('disabled', disabled);
            $('#category').attr('disabled', disabled);
            $('#delivery').attr('disabled', disabled);
        }

        function getDataForLang(lang) {
            blockUI();
            
            axios.post('/cms/admin/stores/data-for-lang', {
                lang_id: lang
            }).then(function(response) {
                if (response.data.data.regions.length != 0) {
                    response.data.data.regions.map((region) => {
                        $('#region').append(new Option(region.name, region.region_id));
                        $('#region').selectpicker("refresh");
                    });

                } else {
                    controlFormInputs(true);
                }

                if (response.data.data.category.length != 0) {

                    response.data.data.category.map((cat) => {
                        $('#category').append(new Option(cat.title, cat.store_category_id));
                        $('#category').selectpicker("refresh");
                    });
                } else {
                    controlFormInputs(true);
                }

            }).catch(function(error) {});
            unBlockUI();
        }


        
</script>
@endempty
<script>
    function performStore(id) {
            blockUI();
            let days = $('#day:checked').map(function(i, e) {
                return e.value;
            }).get().filter(function(e) {
                return e != 'on';
            });

            let days2 = $('#day2:checked').map(function(i, e) {
                return e.value;
            }).get().filter(function(e) {
                return e != 'on';
            });


            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('note', document.getElementById('note').value);
            formData.append('language', document.getElementById('language').value);
            @empty($store)

                formData.append('logo', document.getElementById('logo').files[0]);
                formData.append('cover', document.getElementById('cover').files[0]);
                formData.append('mobile', document.getElementById('mobile').value);
                formData.append('email', document.getElementById('email').value);
                // formData.append('password', document.getElementById('password').value);
                formData.append('longitude', document.getElementById('longitude').value);
                formData.append('latitude', document.getElementById('latitude').value);
                formData.append('category', document.getElementById('category').value);
                formData.append('type', document.getElementById('type').value);
                formData.append('region', document.getElementById('region').value);
                formData.append('delivery', document.getElementById('delivery').checked);
                formData.append('type', document.getElementById('type').value);
                formData.append('active', document.getElementById('active').checked);
               
            @endempty

            if (id == null) {
                store('/cms/admin/stores', formData);
                
            } else {
                // unBlockUI();
                store('/cms/admin/stores/' + id + '/translation', formData);
            }
            unBlockUI();
        }


        function blockUI() {
            KTApp.blockPage({
                overlayColor: 'blue',
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
        }

        function unBlockUI() {
            KTApp.unblockPage();
        }
</script>
@endsection