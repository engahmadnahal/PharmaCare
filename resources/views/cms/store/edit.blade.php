@extends('cms.parent')

@section('page-name', __('cms.store'))
@section('main-page', __('cms.content_management'))
@section('sub-page', __('cms.store'))
@section('page-name-small', __('cms.update'))

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
                        @empty($storeTrans)
                            {{ __('cms.update') }}
                        @else
                            {{ __('cms.update_trans') }}
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
                        @empty($store)
                            <div class="form-group row mt-4">
                                <label class="col-3 col-form-label">{{ __('cms.language') }}:<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-9 col-sm-12">
                                    <div class="dropdown bootstrap-select form-control dropup">
                                        <select class="form-control selectpicker" data-size="7" id="language"
                                            title="Choose one of the following..." tabindex="null" data-live-search="true">
                                            @foreach ($languages as $language)
                                                <option value="{{ $language->id }}" @selected($language->id == $storeTrans->language_id)>
                                                    {{ $language->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <span class="form-text text-muted">{{ __('cms.please_select') }}
                                        {{ __('cms.language') }}</span>
                                </div>
                            </div>
                        @endempty


                        @empty($store)

                            <x-input id="name" type="text" name="{{ __('cms.name') }}"
                                value="{{ $storeTrans->name }}" />
                            <x-input id="address" type="text" name="{{ __('cms.address') }}"
                                value="{{ $storeTrans->address }}" />
                            <x-input id="note" type="text" name="{{ __('cms.notes') }}"
                                value="{{ $storeTrans->note }}" />
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-3">

                                    </div>
                                    <div class="col-9">
                                        <button type="button" onclick="performUpdate()"
                                            class="btn btn-primary mr-2">{{ __('cms.save') }}</button>
                                        <button type="reset" class="btn btn-secondary">{{ __('cms.cancel') }}</button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="separator separator-dashed my-10"></div>
                            <x-input id="mobile" type="text" name="{{ __('cms.mobile') }}" value="{{$store->mobile}}"/>
                            <x-input id="email" type="text" name="{{ __('cms.email') }}" value="{{$store->email}}"/>
                            <x-input id="longitude" type="text" name="{{ __('cms.longitude') }}" value="{{$store->longitude}}"/>
                            <x-input id="latitude" type="text" name="{{ __('cms.latitude') }}" value="{{$store->latitude}}"/>

                            <div class="form-group row mt-4">
                                <label class="col-3 col-form-label">{{ __('cms.regions') }}:<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-9 col-sm-12">
                                    <div class="dropdown bootstrap-select form-control dropup">
                                        <select class="form-control selectpicker" data-size="7" id="region"
                                            title="Choose one of the following..." tabindex="null" data-live-search="true">
                                            @foreach ($regions as $r)
                                            <option value="{{ $r->id }}" @selected($r->id == $store->region_id)>{{ $r->name }}</option>
                                        @endforeach
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
                                            @foreach ($category as $c)
                                            <option value="{{ $c->store_category_id }}" @selected($c->store_category_id == $store->store_category_id)>{{ $c->title }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">{{ __('cms.please_select') }}
                                        {{ __('cms.store-category') }}</span>
                                </div>
                            </div>



                            <div class="separator separator-dashed my-10"></div>
                            <h3 class="text-dark font-weight-bold mb-10">{{ __('cms.settings') }}</h3>


                            <div class="form-group row mt-4">
                                <label class="col-3 col-form-label">{{ __('cms.type-store') }}:<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-9 col-sm-12">
                                    <div class="dropdown bootstrap-select form-control dropup">
                                        <select class="form-control selectpicker" data-size="7" id="type"
                                            title="Choose one of the following..." tabindex="null" data-live-search="true">
                                            <option value="main_branch" @selected($store->type == "main_branch")>{{ __('cms.main_branch') }}</option>
                                            <option value="sub_branch" @selected($store->type == "sub_branch")>{{ __('cms.sub_branch') }}</option>
                                            <option value="normal" @selected($store->type == "normal")>{{ __('cms.normal') }}</option>
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
                                            <input type="checkbox" @checked($store->isDelivary) id="delivery">
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
                                            <input type="checkbox" @checked(!$store->blocked) id="active">
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
                                    style="background-image: url({{ Storage::url($store->logo) }})">
                                    <div class="image-input-wrapper"></div>

                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="logo" id="logo" accept=".png, .jpg, .jpeg">
                                        <input type="hidden" name="profile_avatar_remove">
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

                        <div class="form-group col-6">
                            <label class="col-12 col-form-label">{{ __('cms.cover_image') }}:</label>
                            <div class="col-9">
                                <div class="image-input image-input-empty image-input-outline" id="kt_image_6"
                                    style="background-image: url({{Storage::url($store->cover)}})">
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

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-3">

                                </div>
                                <div class="col-9">
                                    <button type="button" onclick="performUpdateStore()"
                                        class="btn btn-primary mr-2">{{ __('cms.save') }}</button>
                                    <button type="reset" class="btn btn-secondary">{{ __('cms.cancel') }}</button>
                                </div>
                            </div>
                        </div>

                    @endempty


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
        var image = new KTImageInput('kt_image_5');
        var cover = new KTImageInput('kt_image_6');

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
    <script>
        @empty($store)
            function performUpdate() {

                let data = {
                    name: document.getElementById('name').value,
                    address: document.getElementById('address').value,
                    note: document.getElementById('note').value,
                    language: document.getElementById('language').value,
                };

                update('/cms/admin/stores/translations/{{ $storeTrans->id }}', data, '/cms/admin/stores');
            }
        @else
            var image = new KTImageInput('kt_image_5');
            controlFormInputs(true);
            

            function getDataForLang(lang) {
                blockUI();
                axios.post('/cms/admin/stores/data-for-lang', {
                    lang_id: lang
                }).then(function(response) {
                    console.log(response.data.data);
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

            function performUpdateStore() {

                let days = $('input[type=checkbox]:checked').map(function(i, e) {
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
                formData.append('logo', document.getElementById('logo').files[0]);
                formData.append('cover', document.getElementById('cover').files[0]);
                formData.append('mobile', document.getElementById('mobile').value);
                formData.append('email', document.getElementById('email').value);
                formData.append('longitude', document.getElementById('longitude').value);
                formData.append('latitude', document.getElementById('latitude').value);
                formData.append('category', document.getElementById('category').value);
                formData.append('type', document.getElementById('type').value);
                formData.append('region', document.getElementById('region').value);
                formData.append('delivery', document.getElementById('delivery').checked);
                formData.append('type', document.getElementById('type').value);
                formData.append('active', document.getElementById('active').checked);
               
                formData.append('_method', 'put');

                store('/cms/admin/stores/{{$store->id}}', formData);
            }
        @endempty
    </script>
@endsection
