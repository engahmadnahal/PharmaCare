@extends('cms.parent')

@section('page-name',__('cms.create_employee'))
@section('main-page',__('cms.employees'))
@section('sub-page',__('cms.create'))

@section('styles')
<link href="{{asset('cms/css/file-upload.css')}}" rel="stylesheet" />
@endsection

@section('content')
<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title"></h3>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.name')}}:</label>
                                <input type="text" class="form-control" id="name" placeholder="{{__('cms.enter_name')}}"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.email')}}:</label>
                                <input type="email" class="form-control" id="email" placeholder="{{__('cms.enter_email')}}"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.mobile')}}:</label>
                                <input type="text" class="form-control" id="mobile" placeholder="{{__('cms.enter_mobile')}}"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.national_id')}}:</label>
                                <input type="text" class="form-control" id="national_id" placeholder="{{__('cms.enter_national_id')}}"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('cms.address')}}:</label>
                                <input type="text" class="form-control" id="address" placeholder="{{__('cms.enter_address')}}"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.avatar')}}:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="avatar" accept="image/png,image/jpeg">
                                    <label class="custom-file-label" for="avatar">{{__('cms.choose_image')}}</label>
                                    <small class="form-text text-muted">{{__('cms.allowed_files')}}: PNG, JPG</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.certificate')}}:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="certificate" accept="application/pdf">
                                    <label class="custom-file-label" for="certificate">{{__('cms.choose_file')}}</label>
                                    <small class="form-text text-muted">{{__('cms.allowed_files')}}: PDF</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.dob')}}:</label>
                                <input type="date" class="form-control" id="dob"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.role')}}:</label>
                                <select class="form-control" id="role_id">
                                    <option value="">{{__('cms.select_role')}}</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
// Handle file input labels
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});

function performStore() {
    let formData = new FormData();
    formData.append('name', document.getElementById('name').value);
    formData.append('email', document.getElementById('email').value);
    formData.append('mobile', document.getElementById('mobile').value);
    formData.append('address', document.getElementById('address').value);
    formData.append('national_id', document.getElementById('national_id').value);
    formData.append('dob', document.getElementById('dob').value);
    formData.append('role_id', document.getElementById('role_id').value);

    // Handle file uploads
    const avatarFile = document.getElementById('avatar').files[0];
    const certificateFile = document.getElementById('certificate').files[0];
    
    if (avatarFile) {
        formData.append('avatar', avatarFile);
    }
    
    if (certificateFile) {
        formData.append('certificate', certificateFile);
    }

    axios.post('/cms/admin/employees', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(function (response) {
        toastr.success(response.data.message);
        window.location.href = '/cms/admin/employees';
    })
    .catch(function (error) {
        if (error.response && error.response.data && error.response.data.message) {
            toastr.error(error.response.data.message);
        } else {
            toastr.error('An error occurred while saving');
        }
    });
}
</script>
@endsection