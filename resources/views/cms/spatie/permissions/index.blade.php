@extends('cms.parent')

@section('page-name',__('cms.permissions'))
@section('main-page',__('cms.roles_permissions'))
@section('sub-page',__('cms.permissions'))
@section('page-name-small',__('cms.index'))

@section('styles')

@endsection

@section('content')
<!--begin::Advance Table Widget 5-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weright-bolder text-dark">{{__('cms.permissions')}}</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_2">
                <thead>
                    <tr class="text-uppercase">
                        <th style="min-width: 150px">{{__('cms.name')}}</th>
                        {{-- <th style="min-width: 120px">Auth Type</th> --}}
                        <th class="pr-0 text-right" style="min-width: 160px">{{__('cms.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                    <tr>
                        <td class="pl-0">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$permission->name}}</a>
                        </td>
                        {{-- <td class="pl-0">
                            <span
                                class="label label-lg @if($permission->guard_name == 'admin') label-light-success @else label-light-warning @endif label-inline">{{ucfirst($permission->guard_name)}}</span>
                        </td> --}}
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Body-->
</div>
<!--end::Advance Table Widget 5-->
@endsection

@section('scripts')
<script src="{{asset('assets/js/pages/widgets.js')}}"></script>
<script>
    function performDestroy(id,reference) {
        confirmDestroy('/cms/admin/permissions', id, reference);
    }
</script>
@endsection