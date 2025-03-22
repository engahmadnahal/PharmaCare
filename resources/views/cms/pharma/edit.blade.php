@extends('cms.parent')

@section('page-name',__('cms.edit_pharmaceutical'))
@section('main-page',__('cms.pharmaceuticals'))
@section('sub-page',__('cms.update'))

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
                                <label>{{__('cms.name_en')}}:</label>
                                <input type="text" class="form-control" id="name_en"
                                    value="{{$pharmaceutical->name_en}}" placeholder="{{__('cms.name_en')}}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.name_ar')}}:</label>
                                <input type="text" class="form-control" id="name_ar"
                                    value="{{$pharmaceutical->name_ar}}" placeholder="{{__('cms.name_ar')}}" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('cms.email')}}:</label>
                                <input type="email" class="form-control" id="email"
                                    value="{{$pharmaceutical->email}}" placeholder="{{__('cms.email')}}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('cms.mobile')}}:</label>
                                <input type="text" class="form-control" id="mobile"
                                    value="{{$pharmaceutical->mobile}}" placeholder="{{__('cms.mobile')}}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('cms.phone')}}:</label>
                                <input type="text" class="form-control" id="phone"
                                    value="{{$pharmaceutical->phone}}" placeholder="{{__('cms.phone')}}" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.commercial_register')}}:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="commercial_register" accept="application/pdf">
                                    <label class="custom-file-label" for="commercial_register">
                                        {{$pharmaceutical->commercial_register_file ?? __('cms.choose_file')}}
                                    </label>
                                </div>
                                @if($pharmaceutical->commercial_register_file)
                                <div class="current-file mt-2">
                                    <a href="{{Storage::url($pharmaceutical->commercial_register_file)}}" target="_blank"
                                        class="btn btn-sm btn-info">
                                        <i class="fas fa-file-pdf"></i> {{__('cms.view_current_file')}}
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.tax_number')}}:</label>
                                <input type="text" class="form-control" id="tax_number"
                                    value="{{$pharmaceutical->tax_number}}" placeholder="{{__('cms.tax_number')}}" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.type')}}:</label>
                                <select class="form-control" id="type">
                                    <option value="{{\App\Enum\PharmType::PARTNER}}" {{$pharmaceutical->type == 'partner' ? 'selected' : ''}}>
                                        {{__('cms.partner')}}
                                    </option>
                                    <option value="{{\App\Enum\PharmType::BENEFICIARY}}" {{$pharmaceutical->type == 'beneficiary' ? 'selected' : ''}}>
                                        {{__('cms.beneficiary')}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.has_branch')}}:</label>
                                <select class="form-control" id="has_branch">
                                    <option value="1" {{$pharmaceutical->has_branch ? 'selected' : ''}}>{{__('cms.yes')}}</option>
                                    <option value="0" {{!$pharmaceutical->has_branch ? 'selected' : ''}}>{{__('cms.no')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('cms.country')}}:</label>
                                <select class="form-control" id="country_id">
                                    @foreach($countries as $country)
                                    <option value="{{$country->id}}"
                                        {{$pharmaceutical->country_id == $country->id ? 'selected' : ''}}>
                                        {{$country->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('cms.city')}}:</label>
                                <select class="form-control" id="city_id">
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}"
                                        {{$pharmaceutical->city_id == $city->id ? 'selected' : ''}}>
                                        {{$city->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('cms.region')}}:</label>
                                <select class="form-control" id="region_id">
                                    @foreach($regions as $region)
                                    <option value="{{$region->id}}"
                                        {{$pharmaceutical->region_id == $region->id ? 'selected' : ''}}>
                                        {{$region->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('cms.address')}}:</label>
                                <input type="text" class="form-control" id="address"
                                    value="{{$pharmaceutical->address}}" placeholder="{{__('cms.address')}}" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.status')}}:</label>
                                <select class="form-control" id="status">
                                    <option value="1" {{$pharmaceutical->status ? 'selected' : ''}}>{{__('cms.active')}}</option>
                                    <option value="0" {{!$pharmaceutical->status ? 'selected' : ''}}>{{__('cms.inactive')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.parent')}}:</label>
                                <select class="form-control" id="parent_id">
                                    <option value="">{{__('cms.select_parent')}}</option>
                                    @foreach($pharmaceuticals as $parent)
                                    @if($parent->id != $pharmaceutical->id)
                                    <option value="{{$parent->id}}"
                                        {{$pharmaceutical->parent_id == $parent->id ? 'selected' : ''}}>
                                        {{$parent->name}}
                                    </option>
                                    @endif
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
                            <button type="button" onclick="performUpdate()"
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
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    function performUpdate() {
        let formData = new FormData();
        formData.append('_method', 'PUT');
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

        // Handle file upload only if new file is selected
        const commercialRegister = document.getElementById('commercial_register').files[0];
        if (commercialRegister) {
            formData.append('commercial_register', commercialRegister);
        }

        axios.post('/cms/admin/pharmaceuticals/{{$pharmaceutical->id}}', formData, {
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