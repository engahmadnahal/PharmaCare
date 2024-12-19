@extends('cms.auth.profile.profile')

@section('profile-content')
<div class="flex-row-fluid ml-lg-8">
    <!--begin::Card-->
    <div class="card card-custom card-stretch">
        <!--begin::Header-->
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">{{__('cms.image-cover')}}</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">---</span>
            </div>
            <div class="card-toolbar">
                <button type="button"
                    onclick="performEdit()"
                    class="btn btn-success mr-2">{{__('cms.save')}}</button>
                <button type="reset" class="btn btn-secondary">{{__('cms.cancel')}}</button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form class="form">
            <!--begin::Body-->
            <div class="card-body">
                <div class="row">
                    <label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6">
                        <h5 class="font-weight-bold mb-6">{{__('cms.info')}}</h5>
                    </div>
                </div>

                <div class="row">

                <div class="form-group col-5">
                    <label class="col-3 col-form-label">{{__('cms.image')}}:</label>
                    <div class="col-9">
                        <div class="image-input image-input-empty image-input-outline" id="profile_image"
                            style="background-image: url({{Storage::url($user->logo)}})">
                            <div class="image-input-wrapper"></div>

                            <label
                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" id="logo" accept=".png, .jpg, .jpeg">
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

                <div class="form-group col-7">
                    <label class="col-3 col-form-label">{{__('cms.cover_image')}}:</label>
                    <div class="col-9">
                        <div class="image-input image-input-empty image-input-outline" id="cover_image"
                            style="background-image: url({{Storage::url($user->cover)}})">
                            <div class="image-input-wrapper"></div>

                            <label
                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                data-action="change" data-toggle="tooltip" title=""
                                data-original-title="Change avatar">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" id="cover" accept=".png, .jpg, .jpeg">
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
                
            </div>
            <!--end::Body-->
        </form>
        <!--end::Form-->
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('cms/assets/js/pages/crud/file-upload/image-input.js')}}"></script>

<script>
    var image = new KTImageInput('profile_image');
    var image = new KTImageInput('cover_image');
   
        function performEdit(){
            let formData = new FormData();
                formData.append('_method', 'PUT');
                formData.append('logo', document.getElementById('logo').files[0]);
                formData.append('cover', document.getElementById('cover').files[0]);
                store('/cms/admin/profile/logo-and-image', formData);

       
        }
        

   
</script>
@endsection