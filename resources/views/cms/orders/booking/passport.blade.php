@extends('cms.parent')

@section('page-name', __('cms.passport'))
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
                        <h2>Passport (Total : {{$data->total}} {{$data->currencyCode}})</h2>
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
                                            Type
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{$detailsOptionPassport->title}}</td>
                                </tr>
                                <!--end::Date-->
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
                                        {{$data?->quantity}}
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
                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                        <!--begin::Table head-->
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark"></span>
                                <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                            </h3>
                            <div class="card-toolbar">
                                <a href="{{!is_null($data) ? route('order_studios.download',[Crypt::encryptString($data::class),$data?->id,$data?->user_id,$order->id]) : '#'}}" class="btn btn-light-primary me-3">
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="black"></path>
                                            <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.2C9.7 3 10.2 3.20001 10.4 3.60001ZM16 12H13V9C13 8.4 12.6 8 12 8C11.4 8 11 8.4 11 9V12H8C7.4 12 7 12.4 7 13C7 13.6 7.4 14 8 14H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V14H16C16.6 14 17 13.6 17 13C17 12.4 16.6 12 16 12Z" fill="black"></path>
                                            <path opacity="0.3" d="M11 14H8C7.4 14 7 13.6 7 13C7 12.4 7.4 12 8 12H11V14ZM16 12H13V14H16C16.6 14 17 13.6 17 13C17 12.4 16.6 12 16 12Z" fill="black"></path>
                                        </svg>
                                    </span>
                                        Download</a>
                                
                    
                            </div>
                        </div>
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-100px"># {{ __('cms.images') }}</th>
                                <th class="min-w-100px"></th>
                                <th class="min-w-100px text-end">{{ __('cms.actions') }}</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody class="fw-bold text-gray-600">
                            @foreach ($data?->images ?? [] as $image)
                            <tr>
                                <!--begin::Product-->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!--begin::Title-->
                                        <div class="">
                                            <a href="#" class="fw-bolder text-gray-600 text-hover-primary">#{{++$loop->index}}
                                            </a>
                                            {{-- <div class="fs-7 text-muted">{{$item->object->masterService->description}}</div> --}}
                                        </div>
                                        &numsp;
                                        <!--end::Title-->
                                        <!--begin::Thumbnail-->
                                        <a href="#" class="symbol symbol-50px">
                                            <span class="symbol-label" style="background-image:url({{Storage::url($image->path)}});"></span>
                                        </a>
                                    </div>
                                </td>
                                <td></td>
                                <td class="pr-0 text-right">
                                    <a href="{{Storage::url($image->path)}}" target="_blanck" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
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
                                <!--end::Product-->
                                <!--begin::SKU-->

                                <!--end::Total-->
                            </tr>
                        @endforeach
                        </tbody>
                        <!--end::Table head-->
                    </table>
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
