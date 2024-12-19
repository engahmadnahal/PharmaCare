@extends('cms.parent')

@section('page-name',__('cms.sub_category'))
@section('main-page',__('cms.shop_content_management'))
@section('sub-page',__('cms.sub_category'))
@section('page-name-small',__('cms.update'))

@section('styles')

@endsection

@section('content')
<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">

        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.language')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="language"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($languages as $language)
                                    <option value="{{$language->id}}" @selected($subCategory->language_id ==
                                        $language->id)>{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.type')}}</span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    @empty($subCategory)
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.country')}}:<span
                                class="text-danger">*</span></label>
                        {{-- <div class="col-lg-4 col-md-9 col-sm-12">
                            <select class="form-control form-control-solid" title='select' id="items">
                            </select>
                        </div> --}}
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="country"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.type')}}</span>
                        </div>
                    </div>
                    @endempty
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.name')}}:</label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <input type="text" class="form-control" id="name" placeholder="{{__('cms.name')}}"
                                value="{{$subCategory->name}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.name')}}</span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="row">
                        <div class="form-group col-3">
                            <label class="col-3 col-form-label">{{__('cms.image')}}:</label>
                            <div class="col-9">
                                <div class="image-input image-input-empty image-input-outline" id="kt_image_5"
                                    style="background-image: url(https://abraj.mr-dev.tech/assets/media/users/blank.png)">
                                    <div class="image-input-wrapper"></div>

                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
                                        <input type="hidden" name="profile_avatar_remove">
                                    </label>

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
                        <div class="form-group col-3">
                            <label class="col-3 col-form-label">{{__('cms.icon')}}:</label>
                            <div class="col-9">
                                <div class="image-input image-input-empty image-input-outline" id="kt_image_6"
                                    style="background-image: url(https://abraj.mr-dev.tech/assets/media/users/blank.png)">
                                    <div class="image-input-wrapper"></div>

                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
                                        <input type="hidden" name="profile_avatar_remove">
                                    </label>

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
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.settings')}}</h3>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.active')}}</label>
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
                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="performEdit({{$subCategory->id ?? null}})"
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
    function blockUI () {
        KTApp.blockPage({
            overlayColor: 'blue',
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });
    }

    function unBlockUI () {
        KTApp.unblockPage();
    }

</script>
<script>
    var image = new KTImageInput('kt_image_5');
    var icon = new KTImageInput('kt_image_6');
    
    function performEdit(){
    blockUI();
    let formData = new FormData();
    formData.append('name',document.getElementById('name').value);
    formData.append('language',document.getElementById('language').value);
    formData.append('active',document.getElementById('active').checked?1:0);
    formData.append('image',image.input.files[0]);
    formData.append('icon',icon.input.files[0]);
    store('/cms/admin/subCategories/translations/{{$subCategory->id}}', formData, '/cms/admin/subCategories');
    }

    // function performEdit(){
    //     blockUI();
    //     let data = {
    //         language: document.getElementById('language').value,
    //         name: document.getElementById('name').value,
    //     }
    //     update('/cms/admin/subCategories/translations/{{$subCategory->id}}', data, '/cms/admin/subCategories');
    // }
</script>
@endsection