@extends('cms.parent')

@section('page-name',__('cms.serviceStudio'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.serviceStudio'))
@section('page-name-small','Permissions')

@section('styles')

@endsection

@section('content')
<!--begin::Advance Table Widget 5-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center table-hover" id="kt_advance_table_widget_2">
                <thead>
                    <tr class="text-uppercase">
                        <th style="min-width: 150px">{{__('cms.title')}}</th>
                        <th style="min-width: 80px">{{__('cms.status')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $service)
                    <tr>
                        <td class="pl-0">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$service->title}}</a>
                        </td>
                        
                        <td class="pl-0">
                            <div class="checkbox-inline">
                                <label class="checkbox checkbox-success">
                                    <input type="checkbox" name="permission_{{$service->id}}"
                                        @if($service->assign)
                                    checked="checked"
                                    @endif onclick="setService({{$service->id}})">
                                    <span></span>Set</label>
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
    function setService(serviceId) {
        let data = {
            serviceId: serviceId,
        }
        store('/cms/admin/services_booking_studios/{{$studioBranch->id}}/servcies',data);
    }
</script>
@endsection