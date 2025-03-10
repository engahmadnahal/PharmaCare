@extends('cms.parent')


@section('page-name',__('cms.dashboard'))
@section('main-page',__('cms.app_name'))
@section('sub-page',__('cms.dashboard'))
@section('content')
<!--begin::Dashboard-->
<!--begin::Row-->

@if (auth('admin')->check())
    @include('cms.indexes.admin')
@endif

@if (auth('employee')->check())
    @include('cms.indexes.employee')
@endif


<!--end::Dashboard-->
@endsection

@section('scripts')


@endsection