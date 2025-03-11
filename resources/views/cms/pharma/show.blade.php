@extends('cms.parent')

@section('page-name',__('cms.show_pharmaceutical'))
@section('main-page',__('cms.pharmaceuticals'))
@section('sub-page',__('cms.show'))

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
                                <label>{{__('cms.name_en')}}:</label>
                                <input type="text" class="form-control" value="{{$pharmaceutical->name_en}}" 
                                    readonly disabled />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.name_ar')}}:</label>
                                <input type="text" class="form-control" value="{{$pharmaceutical->name_ar}}" 
                                    readonly disabled />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('cms.email')}}:</label>
                                <input type="email" class="form-control" value="{{$pharmaceutical->email}}" 
                                    readonly disabled />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('cms.mobile')}}:</label>
                                <input type="text" class="form-control" value="{{$pharmaceutical->mobile}}" 
                                    readonly disabled />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('cms.phone')}}:</label>
                                <input type="text" class="form-control" value="{{$pharmaceutical->phone}}" 
                                    readonly disabled />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.commercial_register')}}:</label>
                                @if($pharmaceutical->commercial_register_file)
                                <div class="current-file">
                                    <a href="{{Storage::url($pharmaceutical->commercial_register_file)}}" target="_blank" 
                                        class="btn btn-info btn-block">
                                        <i class="fas fa-file-pdf mr-2"></i> {{__('cms.view_commercial_register')}}
                                    </a>
                                </div>
                                @else
                                <p class="text-muted">{{__('cms.no_file_available')}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.tax_number')}}:</label>
                                <input type="text" class="form-control" value="{{$pharmaceutical->tax_number}}" 
                                    readonly disabled />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.type')}}:</label>
                                <input type="text" class="form-control" 
                                    value="{{__('cms.' . $pharmaceutical->type)}}" readonly disabled />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.has_branch')}}:</label>
                                <input type="text" class="form-control" 
                                    value="{{$pharmaceutical->has_branch ? __('cms.yes') : __('cms.no')}}" 
                                    readonly disabled />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('cms.country')}}:</label>
                                <input type="text" class="form-control" 
                                    value="{{$pharmaceutical->country->name}}" readonly disabled />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('cms.city')}}:</label>
                                <input type="text" class="form-control" 
                                    value="{{$pharmaceutical->city->name}}" readonly disabled />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__('cms.region')}}:</label>
                                <input type="text" class="form-control" 
                                    value="{{$pharmaceutical->region->name}}" readonly disabled />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('cms.address')}}:</label>
                                <input type="text" class="form-control" value="{{$pharmaceutical->address}}" 
                                    readonly disabled />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.status')}}:</label>
                                <div class="form-control-static">
                                    <span class="label label-lg {{$pharmaceutical->status ? 'label-light-success' : 'label-light-danger'}} label-inline">
                                        {{$pharmaceutical->status ? __('cms.active') : __('cms.inactive')}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.parent')}}:</label>
                                <input type="text" class="form-control" 
                                    value="{{$pharmaceutical->parent ? $pharmaceutical->parent->name : __('cms.no_parent')}}" 
                                    readonly disabled />
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.created_at')}}:</label>
                                <input type="text" class="form-control" 
                                    value="{{$pharmaceutical->created_at->format('Y-m-d H:i')}}" readonly disabled />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('cms.updated_at')}}:</label>
                                <input type="text" class="form-control" 
                                    value="{{$pharmaceutical->updated_at->format('Y-m-d H:i')}}" readonly disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('pharmaceuticals.edit', $pharmaceutical->id)}}" 
                        class="btn btn-primary mr-2">{{__('cms.edit')}}</a>
                    <a href="{{route('pharmaceuticals.index')}}" 
                        class="btn btn-secondary">{{__('cms.back')}}</a>
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
<!-- No scripts needed for show page since it's read-only -->
@endsection