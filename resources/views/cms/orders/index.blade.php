@extends('cms.parent')

@section('page-name', __('cms.orders'))
@section('main-page', __('cms.shop_content_management'))
@section('sub-page', __('cms.orders'))
@section('page-name-small', __('cms.index'))

@section('styles')

@endsection

@section('content')
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{ __('cms.orders') }}</span>
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
                        <th class="pl-0" style="min-width: 100px">{{ __('cms.order_number') }}</th>
                        <th style="min-width: 120px">{{ __('cms.payment_method') }}</th>
                        <th style="min-width: 120px">{{ __('cms.payment_status') }}</th>
                        <th style="min-width: 120px">{{ __('cms.discount') }}</th>
                        <th style="min-width: 120px">{{ __('cms.total') }}</th>
                        <th style="min-width: 120px">{{ __('cms.status') }}</th>
                        <th style="min-width: 150px">{{ __('cms.user_full_name') }}</th>
                        <th style="min-width: 120px">{{ __('cms.user_mobile') }}</th>
                        <th class="pr-0 text-right" style="min-width: 100px">{{ __('cms.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $order)
                    <tr>
                        <td class="pl-0">
                            <a href="{{ route('cms.employee.orders.show', $order->order_num) }}"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">
                                {{ $order->order_num }}
                            </a>
                        </td>
                        <td>
                            <span class="label label-lg label-light-primary label-inline">
                                {{ $order->payment_method }}
                            </span>
                        </td>
                        <td>
                            <span class="label label-lg {{ $order->payment_status ? 'label-light-success' : 'label-light-danger' }} label-inline">
                                {{ $order->payment_status ? __('cms.paid') : __('cms.unpaid') }}
                            </span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                {{ $order->discount }}
                            </span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                {{ $order->total }}
                            </span>
                        </td>
                        <td>
                            <span class="label label-lg label-light-{{ $order->status_color }} label-inline">
                                {{ __('cms.' . $order->status) }}
                            </span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                {{ $order->user?->full_name }}
                            </span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                {{ $order->user?->mobile }}
                            </span>
                        </td>
                        <td class="pr-0 text-right">
                            <a href="{{ route('cms.employee.orders.show', $order->id) }}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
                                        <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
                                    </svg>
                                </span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links('pagination::bootstrap-5') }}
        </div>
        <!--end::Table-->
    </div>
    <!--end::Body-->
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
@endsection