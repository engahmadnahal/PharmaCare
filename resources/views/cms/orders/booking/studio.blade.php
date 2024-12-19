@extends('cms.parent')

@section('page-name', __('cms.booking_studio'))
@section('main-page', __('cms.orders'))
@section('sub-page', __('cms.services'))
@section('page-name-small', __('cms.show'))

@section('styles')
    @if (App::getLocale() == 'ar')
        <link href="{{ asset('assets/plugins/global/plugins.bundle2.rtl.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle2.rtl.css') }}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{ asset('assets/plugins/global/plugins.bundle2.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle2.css') }}" rel="stylesheet" type="text/css" />
    @endif
@endsection
@section('content')
    <div class="d-flex flex-column gap-7 gap-lg-10">
        <!--begin::Order summary-->
        <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
            <!--begin::Order details-->
            <div class="card card-flush py-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Studio Booking (Total : {{$data->total}} {{$data->currencyCode}})</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm006.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="black"/>
                                                    <path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="black"/>
                                                    </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            User Address
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{$data?->user?->defaultAddressString  ?? '-'}} </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm006.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="black"/>
                                                    <path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="black"/>
                                                    </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            User Name
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{$data?->user?->name  ?? '-'}} </td>
                                </tr>

                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="black"/>
                                                    <path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="black"/>
                                                    </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            Service
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $data?->masterService->title }}</td>
                                </tr>

                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="black"/>
                                                    <path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="black"/>
                                                    </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            Studio Name
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{$data?->studio?->name ?? '-'}}</td>
                                </tr>
                                <!--end::Date-->

                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin008.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="black"/>
                                                    <path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="black"/>
                                                    </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            Services
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        {{$data?->service?->title}}
                                    </td>
                                </tr>

                                <!--begin::Payment method-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin008.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="black"/>
                                                    <path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="black"/>
                                                    </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            Quantity
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        {{$data?->qty}}
                                    </td>
                                </tr>
                                <!--end::Payment method-->
                                <!--begin::Date-->
                               
                                 <!--begin::Payment method-->
                                 <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin008.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="black"/>
                                                    <path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="black"/>
                                                    </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            People No.
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        {{$data?->people_num}}
                                    </td>
                                </tr>
                                <!--end::Payment method-->
                                <!--begin::Date-->
                               

                                
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm006.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="black"/>
                                                    <path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="black"/>
                                                    </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            Date
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{$data?->date  ?? '-'}} </td>
                                </tr>



                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm006.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="black"/>
                                                    <path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="black"/>
                                                    </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            Time
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{$data?->time_from  ?? '-'}} </td>
                                </tr>


                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm006.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M3 13V11C3 10.4 3.4 10 4 10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14H4C3.4 14 3 13.6 3 13Z" fill="black"/>
                                                    <path d="M13 21H11C10.4 21 10 20.6 10 20V4C10 3.4 10.4 3 11 3H13C13.6 3 14 3.4 14 4V20C14 20.6 13.6 21 13 21Z" fill="black"/>
                                                    </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            User Note 
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{$data?->note  ?? '-'}} </td>
                                </tr>


                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>

                    <br>
                    <br>
                    <br>
                    
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <div class="tab-content">
            <!--begin::Tab pane-->
            
            <!--end::Tab pane-->
            <!--begin::Tab pane-->
            <!--end::Tab pane-->
        </div>
        <!--end::Tab content-->
    </div>
@endsection

@section('scripts')

@endsection
