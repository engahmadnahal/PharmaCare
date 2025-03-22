@extends('cms.parent')

@section('page-name',__('cms.pharmaceuticals'))
@section('main-page',__('cms.pharm'))
@section('sub-page',__('cms.pharmaceuticals'))
@section('page-name-small',__('cms.create'))

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
                                <label>{{__('cms.name_en')}}:</label>
                                <input type="text" class="form-control" id="name_en" placeholder="{{__('cms.name_en')}}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.name_ar')}}:</label>
                                <input type="text" class="form-control" id="name_ar" placeholder="{{__('cms.name_ar')}}" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('cms.email')}}:</label>
                                <input type="email" class="form-control" id="email" placeholder="{{__('cms.email')}}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('cms.mobile')}}:</label>
                                <input type="text" class="form-control" id="mobile" placeholder="{{__('cms.mobile')}}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('cms.phone')}}:</label>
                                <input type="text" class="form-control" id="phone" placeholder="{{__('cms.phone')}}" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.commercial_register')}}:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="commercial_register" accept="application/pdf">
                                    <label class="custom-file-label" for="commercial_register">Choose file</label>
                                    <small class="form-text text-muted">Only PDF files are allowed</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.tax_number')}}:</label>
                                <input type="text" class="form-control" id="tax_number" placeholder="{{__('cms.tax_number')}}" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.type')}}:</label>
                                <select class="form-control" id="type">
                                    <option value="{{\App\Enum\PharmType::PARTNER}}">{{__('cms.partner')}}</option>
                                    <option value="{{\App\Enum\PharmType::BENEFICIARY}}">{{__('cms.beneficiary')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.has_branch')}}:</label>
                                <select class="form-control" id="has_branch">
                                    <option value="1">{{__('cms.yes')}}</option>
                                    <option value="0">{{__('cms.no')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
               
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('cms.address')}}:</label>
                                <input type="text" class="form-control" id="address" placeholder="{{__('cms.address')}}"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.status')}}:</label>
                                <select class="form-control" id="status">
                                    <option value="1">{{__('cms.active')}}</option>
                                    <option value="0">{{__('cms.inactive')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.parent')}}:</label>
                                <select class="form-control" id="parent_id">
                                    <option value="">{{__('cms.select_parent')}}</option>
                                    @foreach($pharmaceuticals as $pharmaceutical)
                                        <option value="{{$pharmaceutical->id}}">{{$pharmaceutical->name}}</option>
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
    var cover = new KTImageInput('kt_image_6');

    // Add this to handle file input label
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    function performStore() {
        let formData = new FormData();
        formData.append('name_en', document.getElementById('name_en').value);
        formData.append('name_ar', document.getElementById('name_ar').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('mobile', document.getElementById('mobile').value);
        formData.append('phone', document.getElementById('phone').value);
        formData.append('tax_number', document.getElementById('tax_number').value);
        formData.append('type', document.getElementById('type').value);
        formData.append('has_branch', document.getElementById('has_branch').value);
        formData.append('address', document.getElementById('address').value);
        formData.append('status', document.getElementById('status').value);

        if (document.getElementById('parent_id').value) {
            formData.append('parent_id', document.getElementById('parent_id').value);
        }

        // Handle file upload
        const commercialRegister = document.getElementById('commercial_register').files[0];
        if (commercialRegister) {
            formData.append('commercial_register', commercialRegister);
        }

        axios.post('/cms/admin/pharmaceuticals', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(function(response) {
                toastr.success(response.data.message);
                window.location.href = '/cms/admin/pharmaceuticals';
            })
            .catch(function(error) {
                toastr.error(error.response.data.message);
            });
    }
</script>
@endsection