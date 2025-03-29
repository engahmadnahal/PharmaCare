@extends('cms.parent')

@section('page-name',__('cms.edit_employee'))
@section('main-page',__('cms.employees'))
@section('sub-page',__('cms.edit'))

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
                <h3 class="card-title">{{__('cms.update')}}</h3>
                {{-- <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                    </div>
                </div> --}}
            </div>
            <!--begin::Form-->
            <form id="edit-form">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.name')}}:</label>
                                <input type="text" class="form-control" id="name"
                                    value="{{$employee->name}}" placeholder="{{__('cms.enter_name')}}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.email')}}:</label>
                                <input type="email" class="form-control" id="email"
                                    value="{{$employee->email}}" placeholder="{{__('cms.enter_email')}}" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.mobile')}}:</label>
                                <input type="text" class="form-control" id="mobile"
                                    value="{{$employee->mobile}}" placeholder="{{__('cms.enter_mobile')}}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.national_id')}}:</label>
                                <input type="text" class="form-control" id="national_id"
                                    value="{{$employee->national_id}}" placeholder="{{__('cms.enter_national_id')}}" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('cms.address')}}:</label>
                                <input type="text" class="form-control" id="address"
                                    value="{{$employee->address}}" placeholder="{{__('cms.enter_address')}}" />
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
                                @if($employee->avatar)
                                <div class="current-file mt-2">
                                    <img src="{{Storage::url($employee->avatar)}}" class="img-thumbnail" style="max-height: 100px">
                                    <p class="text-muted mt-2">{{__('cms.current_avatar')}}</p>
                                </div>
                                @endif
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
                                @if($employee->certificate)
                                <div class="current-file mt-2">
                                    <a href="{{Storage::url($employee->certificate)}}" target="_blank"
                                        class="btn btn-sm btn-info">
                                        <i class="fas fa-file-pdf"></i> {{__('cms.view_current_certificate')}}
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.dob')}}:</label>
                                <input type="date" class="form-control" id="dob"
                                    value="{{$employee->dob}}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.pharmaceutical')}}:</label>
                                <select class="form-control" id="pharmaceutical_id">
                                    <option value="">{{__('cms.select_pharmaceutical')}}</option>
                                    @foreach($pharmaceuticals as $pharmaceutical)
                                    <option value="{{$pharmaceutical->id}}"
                                        {{$employee->pharmaceutical_id == $pharmaceutical->id ? 'selected' : ''}}>
                                        {{$pharmaceutical->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.role')}}:</label>
                                <select class="form-control" id="role_id">
                                    <option value="">{{__('cms.select_role')}}</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}"
                                        @selected($assignedRole->id == $role->id)>
                                        {{$role->name}}
                                    </option>
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
                            <button type="button" onclick="performUpdate()" class="btn btn-primary mr-2">{{__('cms.save')}}</button>
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
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    function performUpdate() {
        let formData = new FormData();
        formData.append('_method', 'PUT'); // For Laravel PUT method
        formData.append('name', document.getElementById('name').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('mobile', document.getElementById('mobile').value);
        formData.append('address', document.getElementById('address').value);
        formData.append('national_id', document.getElementById('national_id').value);
        formData.append('dob', document.getElementById('dob').value);
        formData.append('role_id', document.getElementById('role_id').value);
        formData.append('pharmaceutical_id', document.getElementById('pharmaceutical_id').value);

        // Handle optional file uploads
        const avatarFile = document.getElementById('avatar').files[0];
        const certificateFile = document.getElementById('certificate').files[0];

        if (avatarFile) {
            formData.append('avater', avatarFile);
        }

        if (certificateFile) {
            formData.append('certificate', certificateFile);
        }

        axios.post('/cms/admin/employees/{{$employee->id}}', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(function(response) {
                toastr.success(response.data.message);
                window.location.href = '/cms/admin/employees';
            })
            .catch(function(error) {
                toastr.error(error.response.data.message);
            });
    }
</script>
@endsection