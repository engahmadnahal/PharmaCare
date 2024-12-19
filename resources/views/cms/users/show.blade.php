@extends('cms.parent')

@section('page-name', __('cms.users'))
@section('main-page', __('cms.hr'))
@section('sub-page', __('cms.users'))
@section('page-name-small', __('cms.index'))

@section('styles')

@endsection

@section('content')
    <!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <!--begin::Details-->
            <div class="d-flex mb-9">
                <!--begin: Pic-->
                <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                    <div class="symbol symbol-50 symbol-lg-120">
                        <img src="{{ Storage::url($data->avater) }}" alt="image">
                    </div>
                    <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                        <span class="font-size-h3 symbol-label font-weight-boldest"></span>
                    </div>
                </div>
                <!--end::Pic-->
                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between flex-wrap mt-1">
                        <div class="d-flex mr-3">
                            <a href="#"
                                class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{ $data->name }}</a>
                            <a href="#">
                                <i class="flaticon2-correct text-success font-size-h5"></i>
                            </a>
                        </div>
                        <div class="my-lg-0 my-3">
                            {{ __('cms.register_date') }}
                            <a href="#"
                                class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3">{{ Carbon::parse($data->created_at)->format('Y-m-d') }}</a>
                            {{-- <a href="#" class="btn btn-sm btn-info font-weight-bolder text-uppercase">hire</a> --}}
                        </div>
                    </div>
                    <!--end::Title-->
                    <!--begin::Content-->
                    <div class="d-flex flex-wrap justify-content-between mt-1">
                        <div class="d-flex flex-column flex-grow-1 pr-8">
                            <div class="d-flex flex-wrap mb-4">
                                <a href="mailto:{{ $data->email }}"
                                    class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    {{ $data->email }}</a>

                                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                    {{ $data->mobile }}</a>
                            </div>
                            <span class="font-weight-bold text-dark-50">{{ $data->defaultAddressString }}.</span>
                        </div>
                        {{-- <div class="d-flex align-items-center w-25 flex-fill float-right mt-lg-12 mt-8">
                            <span class="font-weight-bold text-dark-75">Progress</span>
                            <div class="progress progress-xs mx-3 w-100">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 63%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="font-weight-bolder text-dark">78%</span>
                        </div> --}}
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->
            <div class="separator separator-solid"></div>
            <!--begin::Items-->
            <div class="d-flex align-items-center flex-wrap mt-8">
                <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" data-toggle="tab"
                                href="#kt_tab_pane_11_1">{{ __('cms.orders') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4" data-toggle="tab"
                                href="#kt_tab_pane_11_2">{{ __('cms.rates') }}</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" data-toggle="tab" href="#kt_tab_pane_11_3">{{__('cms.')}}</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
            <!--begin::Items-->
        </div>
    </div>
    <!--end::Card-->
    <!--begin::Row-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Advance Table Widget 2-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                {{-- <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">New Arrivals</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span>
                    </h3>
                    
                </div> --}}
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-2 pb-0 mt-n3">
                    <div class="tab-content mt-5" id="myTabTables11">
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade show active" id="kt_tab_pane_11_1" role="tabpanel"
                            aria-labelledby="kt_tab_pane_11_1">
                            <!--begin::Table-->
                            
                            @if($orders->count() == 0)
                            <div class="row justify-content-center py-8 px-8 py-md-36 px-md-0 bg-primary">
                                <div class="col-md-9">
                                    <div class="d-flex justify-content-between align-items-md-center flex-column flex-md-row">
                                        <div class="d-flex flex-column px-0 order-2 order-md-1">
                                        </div>
                                        <h1 class="display-3 font-weight-boldest text-white order-1 order-md-2">{{__('cms.no_order')}}</h1>
                                    </div>
                                </div>
                            </div>

                                @else

                            <div class="table-responsive">
                                
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th class="pl-0" style="min-width: 100px">{{ __('cms.code') }}</th>
                                            {{-- <th style="min-width: 150px">{{ __('cms.user_name') }}</th> --}}
                                            <th style="min-width: 150px">{{ __('cms.date') }}</th>
                                            <th style="min-width: 150px">{{ __('cms.count_order') }}</th>
                                            <th style="min-width: 150px">{{ __('cms.status') }}</th>
                                            <th style="min-width: 150px">{{ __('cms.pharm') }}</th>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>

                                                <td class="pl-0">
                                                    <a href="{{ route('order_studios.show', $order->order_num) }}"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $order->order_num ?? '' }}</a>
                                                </td>
                                                {{-- <td>
                                                    <a href="#"
                                                        class="label label-lg label-light-success label-inline">{{ $order?->user?->name ?? '' }}</a>
                                                </td> --}}
                                                <td>
                                                    <span
                                                        class="label label-lg label-light-info label-inline">{{ $order->created_at->format('Y-m-d') }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="label label-lg label-light-info label-inline">{{ $order?->services?->count() }}</span>
                                                </td>

                                                <td>
                                                    <span
                                                        class="label label-lg  label-light-success label-inline">{{ $order?->orderStatus?->name }}</span>
                                                </td>

                                                <td>
                                                    <span
                                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $order?->studioSendOrder?->name ?? 'No Pharms' }}</span>
                                                </td>
                                                

                                            </tr>
                                        @endforeach

                                </table>
                            </div>
                            @endif

                            <!--end::Table-->
                        </div>
                        <!--end::Tap pane-->
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade" id="kt_tab_pane_11_2" role="tabpanel"
                            aria-labelledby="kt_tab_pane_11_2">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                @if($services->count() == 0)
                            <div class="row justify-content-center py-8 px-8 py-md-36 px-md-0 bg-primary">
                                <div class="col-md-9">
                                    <div class="d-flex justify-content-between align-items-md-center flex-column flex-md-row">
                                        <div class="d-flex flex-column px-0 order-2 order-md-1">
                                        </div>
                                        <h1 class="display-3 font-weight-boldest text-white order-1 order-md-2">{{__('cms.no_order')}}</h1>
                                    </div>
                                </div>
                            </div>

                                @else

                            <div class="table-responsive">
                                
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th class="pl-0" style="min-width: 100px">{{ __('cms.code') }}</th>
                                            <th style="min-width: 150px">{{ __('cms.date') }}</th>
                                            <th style="min-width: 150px">{{ __('cms.rate') }}</th>
                                            <th style="min-width: 150px">{{ __('cms.comment') }}</th>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $service)
                                            <tr>

                                                <td class="pl-0">
                                                    <a href="{{ route('order_studios.show', $service?->order->order_num) }}"
                                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $service?->order?->order_num ?? '' }}</a>
                                                </td>
                                               
                                                <td>
                                                    <span
                                                        class="label label-lg label-light-info label-inline">{{ $service?->order->created_at->format('Y-m-d') }}</span>
                                                </td>
                                               

                                                <td>
                                                    <span
                                                        class="label label-lg  label-light-success label-inline">{{ number_format($service?->rate,2) }} / 5</span>
                                                </td>

                                                <td>
                                                    <span
                                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $service?->comment ?? '--' }}</span>
                                                </td>
                                                

                                            </tr>
                                        @endforeach

                                </table>
                            </div>
                            @endif
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Tap pane-->

                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Advance Table Widget 2-->
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/cms/admin/users', id, reference);
        }
    </script>
@endsection
