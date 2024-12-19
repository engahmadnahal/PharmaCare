@extends('cms.parent')

@section('page-name','Specialist Services')
@section('main-page','Roles & Permissions')
@section('sub-page','Specialist Services')
@section('page-name-small','Services')

@section('styles')

@endsection

@section('content')
<!--begin::Advance Table Widget 5-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{$specialist->full_name}} Services</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">Manage Specialist Services</span>
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
                        <th style="min-width: 150px">name</th>
                        {{-- <th style="min-width: 120px">Auth Type</th> --}}
                        <th style="min-width: 80px">Granted</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                    <tr>
                        <td class="pl-0">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$service->name_en}}</a>
                        </td>
                        {{-- <td class="pl-0">
                            <span href="#"
                                class="text-dark-50 font-weight-bolder text-hover-primary font-size-lg">{{ucfirst($service->guard_name)}}</span>
                        </td> --}}
                        <td class="pl-0">
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-success">
                                    <input type="checkbox" name="permission_{{$service->id}}" @if($service->granted)
                                    checked="checked"
                                    @endif onclick="grantPermission('{{$specialist->id}}','{{$service->id}}')">
                                    <span></span>Granted</label>
                            </div>
                        </td>
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
    function grantPermission(specialistId, serviceId) {
        let data = {
            specialist_id: specialistId,
            service_id: serviceId
        }
        store('/cms/admin/specialist-servcies',data);
    }
</script>
@endsection