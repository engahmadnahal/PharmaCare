@extends('cms.parent')

@section('page-name',__('cms.reservations'))
@section('main-page',__('cms.service_management'))
@section('sub-page',__('cms.reservations'))
@section('page-name-small',__('cms.index'))

@section('styles')

@endsection

@section('content')
<!--begin::Advance Table Widget 5-->
<div class="row">
    <div class="col-xl-3">
        <!--begin::Stats Widget 30-->
        <div class="card card-custom bg-info card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span class="svg-icon svg-icon-2x svg-icon-white">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path
                                d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z"
                                fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
                <span
                    class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$waiting}}</span>
                <span class="font-weight-bold text-white font-size-sm">{{__('cms.waiting')}}</span>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 30-->
    </div>
    <div class="col-xl-3">
        <!--begin::Stats Widget 29-->
        <div class="card card-custom bgi-no-repeat card-stretch gutter-b"
            style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-1.svg)">
            <!--begin::Body-->
            <div class="card-body">
                <span class="svg-icon svg-icon-info svg-icon-2x">
                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Money.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M6,5 L18,5 C19.6568542,5 21,6.34314575 21,8 L21,17 C21,18.6568542 19.6568542,20 18,20 L6,20 C4.34314575,20 3,18.6568542 3,17 L3,8 C3,6.34314575 4.34314575,5 6,5 Z M5,17 L14,17 L9.5,11 L5,17 Z M16,14 C17.6568542,14 19,12.6568542 19,11 C19,9.34314575 17.6568542,8 16,8 C14.3431458,8 13,9.34314575 13,11 C13,12.6568542 14.3431458,14 16,14 Z"
                                fill="#000000" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
                <!--end::Svg Icon-->
                <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{$done}}</span>
                <span class="font-weight-bold text-muted font-size-sm">{{__('cms.done')}}</span>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 29-->
    </div>
    <div class="col-xl-3">
        <!--begin::Stats Widget 31-->
        <div class="card card-custom bg-danger card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                {{-- <span class="svg-icon svg-icon-2x svg-icon-white">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"></rect>
                            <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
                            <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
                            <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
                            <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span> --}}

                <span class="svg-icon svg-icon-white svg-icon-2x">
                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Barcode.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <path
                                d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 C2.99998155,19.0000663 2.99998155,19.0000652 2.99998155,19.0000642 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z"
                                fill="#000000" opacity="0.3" />
                            <path
                                d="M13.8,12 C13.1562,12 12.4033,12.7298529 12,13.2 C11.5967,12.7298529 10.8438,12 10.2,12 C9.0604,12 8.4,12.8888719 8.4,14.0201635 C8.4,15.2733878 9.6,16.6 12,18 C14.4,16.6 15.6,15.3 15.6,14.1 C15.6,12.9687084 14.9396,12 13.8,12 Z"
                                fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
                <span
                    class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$rejected}}</span>
                <span class="font-weight-bold text-white font-size-sm">{{__('cms.rejected')}}</span>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 31-->
    </div>
    <div class="col-xl-3">
        <!--begin::Stats Widget 32-->
        <div class="card card-custom bg-dark card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span class="svg-icon svg-icon-2x svg-icon-white">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"></rect>
                            <path
                                d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z"
                                fill="#000000"></path>
                            <path
                                d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z"
                                fill="#000000" opacity="0.3"></path>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
                <span
                    class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 text-hover-primary d-block">{{$canceled}}</span>
                <span class="font-weight-bold text-white font-size-sm">{{__('cms.canceled')}}</span>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 32-->
    </div>
</div>
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{__('cms.reservations')}}</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
        </h3>
        {{-- <div class="card-toolbar">
            <a href="{{route('medical-files.create')}}"
                class="btn btn-info font-weight-bolder font-size-sm">{{__('cms.create')}}</a>
        </div> --}}
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
                <thead>
                    <tr class="text-left">
                        <th class="pl-0" style="min-width: 100px">{{__('cms.order_id')}}</th>
                        <th style="min-width: 150px">{{__('cms.user_name')}}</th>
                        <th style="min-width: 150px">
                            <span class="text-info">{{__('cms.date')}}</span>
                            <span class="svg-icon svg-icon-sm svg-icon-primary">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Down-2.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <rect fill="#000000" opacity="0.3" x="11" y="4" width="2" height="10" rx="1">
                                        </rect>
                                        <path
                                            d="M6.70710678,19.7071068 C6.31658249,20.0976311 5.68341751,20.0976311 5.29289322,19.7071068 C4.90236893,19.3165825 4.90236893,18.6834175 5.29289322,18.2928932 L11.2928932,12.2928932 C11.6714722,11.9143143 12.2810586,11.9010687 12.6757246,12.2628459 L18.6757246,17.7628459 C19.0828436,18.1360383 19.1103465,18.7686056 18.7371541,19.1757246 C18.3639617,19.5828436 17.7313944,19.6103465 17.3242754,19.2371541 L12.0300757,14.3841378 L6.70710678,19.7071068 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(12.000003, 15.999999) scale(1, -1) translate(-12.000003, -15.999999)">
                                        </path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </th>
                        <th style="min-width: 150px">{{__('cms.specialists')}}</th>
                        <th style="min-width: 120px">{{__('cms.status')}}</th>
                        <th style="min-width: 120px">{{__('cms.operations_logs')}}</th>
                        <th class="pr-0 text-right" style="min-width: 100px">{{__('cms.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                    <tr>
                        <td class="pl-0">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">#{{$reservation->id}}</a>
                        </td>
                        <td>
                            <span
                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$reservation->user->name}}
                                - {{$reservation->user->gender_name}}</span>
                            <span class="text-muted font-weight-bold">{{$reservation->user->mobile}}</span>
                        </td>
                        <td>
                            <span
                                class="text-info font-weight-bolder d-block font-size-lg">{{$reservation->date}}</span>
                            <span
                                class="text-muted font-weight-bold">{{\Carbon\Carbon::parse($reservation->from)->format('H:i')}}
                                -
                                {{\Carbon\Carbon::parse($reservation->to)->format('H:i')}}</span>
                        </td>
                        <td>
                            <span
                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$reservation->specialist->name
                                ??'Not Assigned'}}</span>
                            <span class="text-muted font-weight-bold">{{$reservation->service->name_en}}</span>
                        </td>
                        <td>
                            <span
                                class="label label-lg @if($reservation->status == 'Rejected') label-light-danger @else label-light-primary @endif label-inline">{{$reservation->status}}</span>
                        </td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#reservation_{{$reservation->id}}_logs"
                                class="btn btn-light-primary font-weight-bolder font-size-sm">({{$reservation->logs_count}})
                                {{__('cms.operations_logs')}}</a>
                            <div class="modal fade" id="reservation_{{$reservation->id}}_logs" tabindex="-1"
                                role="dialog" aria-labelledby="freservation_{{$reservation->id}}_logs"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{__('cms.operations_logs')}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{__('cms.actor')}}</th>
                                                        <th scope="col">{{__('cms.details')}}</th>
                                                        <th scope="col">{{__('cms.status')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($reservation->logs as $log)
                                                    <tr>
                                                        <td>
                                                            <span
                                                                class="text-info font-weight-bolder d-block font-size-lg">{{$log->actor->name}}</span>
                                                            <span
                                                                class="text-muted font-weight-bold">{{$log->created_at->format('Y-m-d
                                                                H:i')}}</span>
                                                        </td>
                                                        <td>{{$log->notes}}</td>
                                                        <td>
                                                            <span
                                                                class="label label-inline @if($log->status == 'Rejected') label-light-danger @else label-light-primary @endif font-weight-bold">{{$log->status}}</span>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="pr-0 text-right">
                            @if($reservation->status == 'Waiting' || $reservation->status == 'Assigned' ||
                            $reservation->status == 'UnAssigned' || $reservation->status == 'Rejected')
                            <a href="{{route('reservations.edit-specialist',$reservation->id)}}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\User.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <path
                                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path
                                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            @endif
                            @if($reservation->status == 'Waiting')
                            <a href="#" onclick="updateReservationStatus('{{$reservation->id}}')"
                                class="btn btn-icon btn-light btn-hover-danger btn-sm">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Spam.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z M10.5857864,14 L9.17157288,15.4142136 C8.78104858,15.8047379 8.78104858,16.4379028 9.17157288,16.8284271 C9.56209717,17.2189514 10.1952621,17.2189514 10.5857864,16.8284271 L12,15.4142136 L13.4142136,16.8284271 C13.8047379,17.2189514 14.4379028,17.2189514 14.8284271,16.8284271 C15.2189514,16.4379028 15.2189514,15.8047379 14.8284271,15.4142136 L13.4142136,14 L14.8284271,12.5857864 C15.2189514,12.1952621 15.2189514,11.5620972 14.8284271,11.1715729 C14.4379028,10.7810486 13.8047379,10.7810486 13.4142136,11.1715729 L12,12.5857864 L10.5857864,11.1715729 C10.1952621,10.7810486 9.56209717,10.7810486 9.17157288,11.1715729 C8.78104858,11.5620972 8.78104858,12.1952621 9.17157288,12.5857864 L10.5857864,14 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            @endif
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
    function performDestroy(id,reference) {
        confirmDestroy('/cms/admin/medical-files', id, reference);
    }

    function updateReservationStatus(id) {
         let data = {status: 'Rejected'}
        update('/cms/admin/reservations/'+id+'/status-update',data);
    }
</script>
@endsection

{{-- <div class="radio-inline">
    <label class="radio radio-success">
        <input type="radio" name="radios5">
        <span></span>Default</label>
    <label class="radio radio-success">
        <input type="radio" name="radios5" checked="checked">
        <span></span>Checked</label>
    <label class="radio radio-success radio-disabled">
        <input type="radio" name="radios5" disabled="disabled">
        <span></span>Disabled</label>
</div> --}}