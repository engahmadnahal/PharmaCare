@extends('cms.parent')

@section('page-name', __('cms.studio'))
@section('main-page', __('cms.content_management'))
@section('sub-page', __('cms.studio'))
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
                        <h2>Order Details (#{{ $data->order_num }})</h2>
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
                                <!--begin::Date-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21"
                                                    viewBox="0 0 20 21" fill="none">
                                                    <path opacity="0.3"
                                                        d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z"
                                                        fill="black"></path>
                                                    <path
                                                        d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z"
                                                        fill="black"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Date Added
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $data->created_at->format('d/m/Y') }}</td>
                                </tr>
                                <!--end::Date-->
                                <!--begin::Payment method-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin008.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z"
                                                        fill="black"></path>
                                                    <path opacity="0.3"
                                                        d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z"
                                                        fill="black"></path>
                                                    <path
                                                        d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z"
                                                        fill="black"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Payment Method
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ __("cms.{$data->payment_way}") }}
                                        <img src="{{ asset('assets/media/svg/card-logos/visa.svg') }}" class="w-50px ms-2">
                                    </td>
                                </tr>
                                <!--end::Payment method-->
                                <!--begin::Date-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm006.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z"
                                                        fill="black"></path>
                                                    <path opacity="0.3"
                                                        d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z"
                                                        fill="black"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Shipping Method
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ __("cms.{$data->receiving}") }}</td>
                                </tr>
                                <!--end::Date-->
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Order details-->
            <!--begin::Customer details-->
            <div class="card card-flush py-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Customer Details</h2>
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
                                <!--begin::Customer name-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                                        fill="black"></path>
                                                    <path
                                                        d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                                        fill="black"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Customer
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">
                                                <a href="#">
                                                    <div class="symbol-label">
                                                        <img src="{{ Storage::url($data->user->avater) }}"
                                                            alt="{{ $data->user->name }}" class="w-100">
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Name-->
                                            <a href="#"
                                                class="text-gray-600 text-hover-primary">{{ $data->user->name }}</a>
                                            <!--end::Name-->
                                        </div>
                                    </td>
                                </tr>
                                <!--end::Customer name-->
                                <!--begin::Customer email-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                        fill="black"></path>
                                                    <path
                                                        d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                        fill="black"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Email
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <a href="mailto:{{ $data->user->email }}"
                                            class="text-gray-600 text-hover-primary">{{ $data->user->email }}</a>
                                    </td>
                                </tr>
                                <!--end::Payment method-->
                                <!--begin::Date-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z"
                                                        fill="black"></path>
                                                    <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="black"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Phone
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $data->user->mobile }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z"
                                                        fill="black"></path>
                                                    <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="black"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Address
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <a href="https://www.google.com/maps?q={{$data->latitude}},{{$data->longitude}}" target="_blank">Order Address</a>
                                        <br>
                                        {{-- <a href="https://www.google.com/maps?q={{$data->user->defaultAddress?->latitude}},{{$data->user->defaultAddress?->longitude}}" target="_blank">Defualt Address</a> --}}
                                    </td>
                                </tr>

                               

                                <!--end::Date-->
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Customer details-->
            <!--begin::Documents-->
            {{-- <div class="card card-flush py-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Documents</h2>
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
                                <!--begin::Invoice-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                                                        fill="black"></path>
                                                    <path
                                                        d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                                                        fill="black"></path>
                                                    <path
                                                        d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z"
                                                        fill="black"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Invoice
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title=""
                                                data-bs-original-title="View the invoice generated by this order."></i>
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <a href="../../demo1/dist/apps/invoices/view/invoice-3.html"
                                            class="text-gray-600 text-hover-primary">#INV-000414</a>
                                    </td>
                                </tr>
                                <!--end::Invoice-->
                                <!--begin::Shipping-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm006.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z"
                                                        fill="black"></path>
                                                    <path opacity="0.3"
                                                        d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z"
                                                        fill="black"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Shipping
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title=""
                                                data-bs-original-title="View the shipping manifest generated by this order."></i>
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <a href="#" class="text-gray-600 text-hover-primary">#SHP-0025410</a>
                                    </td>
                                </tr>
                                <!--end::Shipping-->
                                <!--begin::Rewards-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm011.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M21.6 11.2L19.3 8.89998V5.59993C19.3 4.99993 18.9 4.59993 18.3 4.59993H14.9L12.6 2.3C12.2 1.9 11.6 1.9 11.2 2.3L8.9 4.59993H5.6C5 4.59993 4.6 4.99993 4.6 5.59993V8.89998L2.3 11.2C1.9 11.6 1.9 12.1999 2.3 12.5999L4.6 14.9V18.2C4.6 18.8 5 19.2 5.6 19.2H8.9L11.2 21.5C11.6 21.9 12.2 21.9 12.6 21.5L14.9 19.2H18.2C18.8 19.2 19.2 18.8 19.2 18.2V14.9L21.5 12.5999C22 12.1999 22 11.6 21.6 11.2Z"
                                                        fill="black"></path>
                                                    <path
                                                        d="M11.3 9.40002C11.3 10.2 11.1 10.9 10.7 11.3C10.3 11.7 9.8 11.9 9.2 11.9C8.8 11.9 8.40001 11.8 8.10001 11.6C7.80001 11.4 7.50001 11.2 7.40001 10.8C7.20001 10.4 7.10001 10 7.10001 9.40002C7.10001 8.80002 7.20001 8.4 7.30001 8C7.40001 7.6 7.7 7.29998 8 7.09998C8.3 6.89998 8.7 6.80005 9.2 6.80005C9.5 6.80005 9.80001 6.9 10.1 7C10.4 7.1 10.6 7.3 10.8 7.5C11 7.7 11.1 8.00005 11.2 8.30005C11.3 8.60005 11.3 9.00002 11.3 9.40002ZM10.1 9.40002C10.1 8.80002 10 8.39998 9.90001 8.09998C9.80001 7.79998 9.6 7.70007 9.2 7.70007C9 7.70007 8.8 7.80002 8.7 7.90002C8.6 8.00002 8.50001 8.2 8.40001 8.5C8.40001 8.7 8.30001 9.10002 8.30001 9.40002C8.30001 9.80002 8.30001 10.1 8.40001 10.4C8.40001 10.6 8.5 10.8 8.7 11C8.8 11.1 9 11.2001 9.2 11.2001C9.5 11.2001 9.70001 11.1 9.90001 10.8C10 10.4 10.1 10 10.1 9.40002ZM14.9 7.80005L9.40001 16.7001C9.30001 16.9001 9.10001 17.1 8.90001 17.1C8.80001 17.1 8.70001 17.1 8.60001 17C8.50001 16.9 8.40001 16.8001 8.40001 16.7001C8.40001 16.6001 8.4 16.5 8.5 16.4L14 7.5C14.1 7.3 14.2 7.19998 14.3 7.09998C14.4 6.99998 14.5 7 14.6 7C14.7 7 14.8 6.99998 14.9 7.09998C15 7.19998 15 7.30002 15 7.40002C15.2 7.30002 15.1 7.50005 14.9 7.80005ZM16.6 14.2001C16.6 15.0001 16.4 15.7 16 16.1C15.6 16.5 15.1 16.7001 14.5 16.7001C14.1 16.7001 13.7 16.6 13.4 16.4C13.1 16.2 12.8 16 12.7 15.6C12.5 15.2 12.4 14.8001 12.4 14.2001C12.4 13.3001 12.6 12.7 12.9 12.3C13.2 11.9 13.7 11.7001 14.5 11.7001C14.8 11.7001 15.1 11.8 15.4 11.9C15.7 12 15.9 12.2 16.1 12.4C16.3 12.6 16.4 12.9001 16.5 13.2001C16.6 13.4001 16.6 13.8001 16.6 14.2001ZM15.4 14.1C15.4 13.5 15.3 13.1 15.2 12.9C15.1 12.6 14.9 12.5 14.5 12.5C14.3 12.5 14.1 12.6001 14 12.7001C13.9 12.8001 13.8 13.0001 13.7 13.2001C13.6 13.4001 13.6 13.8 13.6 14.1C13.6 14.7 13.7 15.1 13.8 15.4C13.9 15.7 14.1 15.8 14.5 15.8C14.8 15.8 15 15.7 15.2 15.4C15.3 15.2 15.4 14.7 15.4 14.1Z"
                                                        fill="black"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->Reward Points
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                title=""
                                                data-bs-original-title="Reward value earned by customer when purchasing this order."></i>
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">600</td>
                                </tr>
                                <!--end::Rewards-->
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div> --}}
            <!--end::Documents-->
        </div>
        <!--end::Order summary-->
        <!--begin::Tab content-->
        <div class="tab-content">
            <!--begin::Tab pane-->
            <div class="tab-pane fade active show" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                <!--begin::Orders-->
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                        <!--begin::Payment address-->
                        {{-- <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                            <!--begin::Background-->
                            <div class="position-absolute top-0 end-0 opacity-10 pe-none text-end">
                                <img src="{{asset('assets/media/icons/duotune/ecommerce/ecm001.svg')}}" class="w-175px">
                            </div>
                            <!--end::Background-->
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Payment Address</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                Unit 1/23 Hastings Road,
                                <br>Melbourne 3000,
                                <br>Victoria,
                                <br>Australia.
                            </div>
                            <!--end::Card body-->
                        </div> --}}
                        <!--end::Payment address-->
                        @if (!is_null($data->orderDate))
                            <!--begin::Shipping address-->
                            <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                <!--begin::Background-->
                                <div class="position-absolute top-0 end-0 opacity-10 pe-none text-end">
                                    <img src="{{ asset('assets/media/icons/duotune/ecommerce/ecm006.svg') }}"
                                        class="w-175px">
                                </div>
                                <!--end::Background-->
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Shipping Address</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    {{ $data->userAddress?->fullAddress ?? '' }},
                                    <br>{{ $data->orderDate?->title ?? '' }},
                                </div>
                                <!--end::Card body-->
                            </div>
                        @endif
                        <!--end::Shipping address-->
                    </div>
                    <!--begin::Product List-->
                    <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Order - {{ $data->order_num }}</h2>
                            </div>
                            <div class="card-toolbar">

                                @can('Change-StatusOrder')
                                    <span class="btn btn-info font-weight-bolder font-size-sm mr-2" data-toggle="modal"
                                        data-target="#order_status">{{ __('cms.order_status') }}</span>


                                    <div class="modal fade" id="order_status" tabindex="-1" role="dialog"
                                        aria-labelledby="order_status" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ __('cms.order_status') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <i aria-hidden="true" class="ki ki-close"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group row mt-4">
                                                        <label class="col-3 col-form-label">{{ __('cms.order_status') }}:<span
                                                                class="text-danger">*</span></label>
                                                        <div class="col-lg-4 col-md-9 col-sm-12">
                                                            <div class="dropdown bootstrap-select form-control dropup">
                                                                <select class="form-control selectpicker" data-size="7"
                                                                    id="order_status_id"
                                                                    title="Choose one of the following..." tabindex="null"
                                                                    data-live-search="true">
                                                                    @foreach ($orderStatus as $status)
                                                                        <option value="{{ $status->id }}"
                                                                            @selected($status->id == $data->order_status_id && $data->status != 'finsh')>{{ $status->name }}
                                                                        </option>
                                                                    @endforeach
                                                                    <option value="finsh" @selected($data->status == 'finsh')>
                                                                        {{ __('cms.finsh_order') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <span class="form-text text-muted">{{ __('cms.please_select') }}
                                                                {{ __('cms.order_status') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="separator separator-dashed my-10"></div>
                                                    <div class="form-group row mt-4">
                                                        <label class="col-3 col-form-label">{{__('cms.note')}}:<span
                                                                class="text-danger"></span></label>
                                                        <div class="col-9">
                                                            <textarea class="form-control" id="note" maxlength="1000" rows="3"
                                                                placeholder="{{__('cms.note')}}" @disabled(!is_null($data->note))>{{$data->note}}</textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" onclick="changeStatus({{ $data->id }})"
                                                        class="btn btn-light-primary font-weight-bold">{{ __('cms.save') }}</button>

                                                    <button type="button" class="btn btn-light-primary font-weight-bold"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan

                                <a href="{{ route('order_studios.download.all', [$data?->user_id, $data->id]) }}"
                                    class="btn btn-light-primary me-3">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="black">
                                            </path>
                                            <path
                                                d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.2C9.7 3 10.2 3.20001 10.4 3.60001ZM16 12H13V9C13 8.4 12.6 8 12 8C11.4 8 11 8.4 11 9V12H8C7.4 12 7 12.4 7 13C7 13.6 7.4 14 8 14H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V14H16C16.6 14 17 13.6 17 13C17 12.4 16.6 12 16 12Z"
                                                fill="black"></path>
                                            <path opacity="0.3"
                                                d="M11 14H8C7.4 14 7 13.6 7 13C7 12.4 7.4 12 8 12H11V14ZM16 12H13V14H16C16.6 14 17 13.6 17 13C17 12.4 16.6 12 16 12Z"
                                                fill="black"></path>
                                        </svg>
                                    </span>
                                    Download</a>


                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="min-w-175px">{{ __('cms.services') }}</th>
                                            <th class="min-w-100px text-end">{{ __('cms.images') }}</th>
                                            <th class="min-w-70px text-end">{{ __('cms.copies') }}</th>
                                            <th class="min-w-100px text-end">{{ __('cms.num_photo') }}</th>
                                            <th class="min-w-100px text-end">{{ __('cms.quantity') }}</th>
                                            {{-- <th class="min-w-100px text-end">{{ __('cms.status') }}</th> --}}
                                            <th class="min-w-100px text-end">{{ __('cms.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        @foreach ($servicesOrder as $item)
                                            <!--begin::Products-->
                                            <tr>
                                                <!--begin::Product-->
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Thumbnail-->
                                                        <a href="#" class="symbol symbol-50px">
                                                            <span class="symbol-label"
                                                                style="background-image:url({{ Storage::url($item->object?->masterService?->poster) }});"></span>
                                                        </a>
                                                        <!--end::Thumbnail-->
                                                        <!--begin::Title-->
                                                        <div class="ms-5">
                                                            <a href="#"
                                                                class="fw-bolder text-gray-600 text-hover-primary">{{ $item->object?->masterService?->title }}
                                                            </a>
                                                            {{-- <div class="fs-7 text-muted">{{$item->object->masterService->description}}</div> --}}
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                </td>
                                                <!--end::Product-->
                                                <!--begin::SKU-->
                                                <td class="text-end">{{ $item->object?->images?->count() ?? '-' }}</td>
                                                <!--end::SKU-->
                                                <!--begin::Quantity-->
                                                <td class="text-end">
                                                    {{ $item->object?->copies ?? '-' }}
                                                </td>
                                                <!--end::Quantity-->
                                                
                                                <!--begin::Total-->
                                                <td class="text-end">
                                                    {{ $item->object?->photo_num ?? '-' }}
                                                </td>
                                              <!--begin::Price-->
                                              <td class="text-end">
                                                {{ $item->object?->quantity ?? '-' }}
                                            </td>
                                            <!--end::Price-->
                                                {{-- <td class="text-end">{{ $item?->status?->name ?? '' }}</td> --}}
                                                <td class="pr-0 text-right">

                                                    <a href="{{ route('order_studios.detials', [Crypt::encryptString($item->object_type), $item->object_id, $data->id]) }}"
                                                        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <path opacity="0.5"
                                                                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                                                        fill="black" />
                                                                    <path
                                                                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                                                        fill="black" />

                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </a>
                                                </td>
                                                <!--end::Total-->
                                            </tr>
                                        @endforeach

                                        <!--end::Products-->
                                        <!--begin::Subtotal-->
                                        <tr>
                                            <td colspan="6" class="text-end">Subtotal</td>
                                            <td class="text-end">{{ $data->subtotal ?? '' }}
                                                {{ $data->currency?->code ?? '' }}</td>
                                        </tr>
                                        <!--end::Subtotal-->
                                        <!--begin::VAT-->
                                        <tr>
                                            <td colspan="6" class="text-end">Tax</td>
                                            <td class="text-end">{{ $data->tax ?? '' }}
                                                {{ $data->currency?->code ?? '' }}</td>
                                        </tr>
                                        <!--end::VAT-->
                                        <!--begin::Shipping-->
                                        <tr>
                                            <td colspan="6" class="text-end">Delivery</td>
                                            <td class="text-end">{{ $data->delivery ?? '' }}
                                                {{ $data->currency?->code ?? '' }}</td>
                                        </tr>
                                        <!--end::Shipping-->
                                        <!--begin::Grand total-->
                                        <tr>
                                            <td colspan="6" class="fs-3 text-dark text-end">Total</td>
                                            <td class="text-dark fs-3 fw-boldest text-end">{{ $data->cost ?? '' }}
                                                {{ $data->currency?->code ?? '' }}</td>
                                        </tr>
                                        <!--end::Grand total-->
                                    </tbody>
                                    <!--end::Table head-->
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Product List-->
                </div>
                <!--end::Orders-->
            </div>
            <!--end::Tab pane-->
            <!--begin::Tab pane-->

            <!--end::Tab pane-->
        </div>
        <!--end::Tab content-->
    </div>
@endsection

@section('scripts')
    <script>
        function changeStatus(orderId) {

            let data = {
                order_id: orderId,
                order_status: $('#order_status_id').val(),
                note: $('#note').val()
            }
            store('/cms/admin/order/change-status', data);

        }
    </script>
@endsection