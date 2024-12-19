@extends('cms.parent')

@section('page-name','Edit Product')
@section('main-page','Content Management')
@section('sub-page','Products')
@section('page-name-small','Edit Product')

@section('styles')

@endsection

@section('content')
<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Edit Product</h3>
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
                    <h3 class="text-dark font-weight-bold mb-10">Basic Info</h3>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Service:</label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="service_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($services as $service)
                                    <option value="{{$service->id}}" @if($service->id ==
                                        $article->service_id) selected @endif>{{$service->name_en}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">Please select service</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">Title (En):<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="title_en" value="{{$article->title_en}}"
                                placeholder="Enter english title" />
                            <span class="form-text text-muted">Please enter english title</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">Title (Ar):<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="title_ar" value="{{$article->title_ar}}"
                                placeholder="Enter arabic title" />
                            <span class="form-text text-muted">Please enter arabic title</span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">Content (En):<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <textarea class="form-control" id="content_en" maxlength="1000" rows="3"
                                placeholder="Enter english content">{{$article->content_en}}</textarea>
                            <span class="form-text text-muted">Please enter english content</span>
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">Content (Ar):<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <textarea class="form-control" id="content_ar" maxlength="1000" rows="3"
                                placeholder="Enter arabic content">{{$article->content_ar}}</textarea>
                            <span class="form-text text-muted">Please enter arabic content</span>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-10"></div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Images:</label>
                        <div class="col-3">
                            <div class="image-input image-input-empty image-input-outline" id="image"
                                style="background-image: url({{Storage::url($article->image)}})">
                                <div class="image-input-wrapper"></div>

                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="profile_avatar_remove" />
                                </label>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">Settings</h3>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Visible</label>
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
                            <button type="button" onclick="performEdit()" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
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
<script src="{{asset('cms/assets/js/pages/crud/forms/widgets/bootstrap-select.js')}}"></script>
<script src="{{asset('cms/assets/js/pages/crud/file-upload/image-input.js')}}"></script>

<script>
    var image = new KTImageInput('image');
    function performEdit(){
        let formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('service_id',document.getElementById('service_id').value);
        formData.append('title_en',document.getElementById('title_en').value);
        formData.append('title_ar',document.getElementById('title_ar').value);
        formData.append('content_en',document.getElementById('content_en').value);
        formData.append('content_ar',document.getElementById('content_ar').value);
        if(image.input.files[0] != undefined){
            formData.append('image',image.input.files[0]);
        }
        formData.append('active',document.getElementById('active').checked);
        store('/cms/admin/articles/{{$article->id}}', formData, '/cms/admin/articles');
    }
</script>
@endsection