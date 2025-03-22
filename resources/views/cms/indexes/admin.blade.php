@extends('cms.parent')

@section('page-name', __('cms.dashboard'))
@section('main-page', __('cms.dashboard'))
@section('sub-page', __('cms.home'))

@section('content')
<div class="d-flex flex-column-fluid">
    <div class="container-fluid">
        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-xl-3">
                <div class="card card-custom bg-primary card-stretch gutter-b">
                    <div class="card-body">
                        <span class="svg-icon svg-icon-white svg-icon-3x">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z" fill="currentColor"/>
                            </svg>
                        </span>
                        <div class="text-inverse-primary font-weight-bolder font-size-h2 mt-3">{{ $counts['orders'] }}</div>
                        <a href="#" class="text-inverse-primary font-weight-bold font-size-lg mt-1">{{ __('cms.total_orders') }}</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="card card-custom bg-success card-stretch gutter-b">
                    <div class="card-body">
                        <span class="svg-icon svg-icon-white svg-icon-3x">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="currentColor"/>
                            </svg>
                        </span>
                        <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">{{ $counts['users'] }}</div>
                        <a href="{{ route('users.index') }}" class="text-inverse-success font-weight-bold font-size-lg mt-1">{{ __('cms.total_users') }}</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="card card-custom bg-danger card-stretch gutter-b">
                    <div class="card-body">
                        <span class="svg-icon svg-icon-white svg-icon-3x">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M20 4H4v2h16V4zm1 10v-2l-1-5H4l-1 5v2h1v6h10v-6h4v6h2v-6h1zm-9 4H6v-4h6v4z" fill="currentColor"/>
                            </svg>
                        </span>
                        <div class="text-inverse-danger font-weight-bolder font-size-h2 mt-3">{{ $counts['pharmacies'] }}</div>
                        <a href="#" class="text-inverse-danger font-weight-bold font-size-lg mt-1">{{ __('cms.total_pharmacies') }}</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="card card-custom bg-info card-stretch gutter-b">
                    <div class="card-body">
                        <span class="svg-icon svg-icon-white svg-icon-3x">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z" fill="currentColor"/>
                            </svg>
                        </span>
                        <div class="text-inverse-info font-weight-bolder font-size-h2 mt-3">{{ $counts['products'] }}</div>
                        <a href="#" class="text-inverse-info font-weight-bold font-size-lg mt-1">{{ __('cms.total_products') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Financial Summary -->
        <div class="row">
            <div class="col-xl-6">
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">{{ __('cms.financial_summary') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="d-flex align-items-center mb-9">
                                    <div class="symbol symbol-40 symbol-light-primary mr-3">
                                        <span class="symbol-label">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                        </span>
                                    </div>
                                    <div>
                                        <div class="font-size-h4 text-dark-75 font-weight-bolder">{{ number_format($totals['orders'], 2) }}</div>
                                        <div class="font-size-sm text-muted font-weight-bold mt-1">{{ __('cms.total_sales') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center mb-9">
                                    <div class="symbol symbol-40 symbol-light-danger mr-3">
                                        <span class="symbol-label">
                                            <span class="svg-icon svg-icon-danger svg-icon-2x">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path d="M12.79 21L3 11.21v2c0 .53.21 1.04.59 1.41l7.79 7.79c.78.78 2.05.78 2.83 0l6.21-6.21c.78-.78.78-2.05 0-2.83L12.79 21z" fill="currentColor"/>
                                                </svg>
                                            </span>
                                        </span>
                                    </div>
                                    <div>
                                        <div class="font-size-h4 text-dark-75 font-weight-bolder">{{ number_format($totals['discounts'], 2) }}</div>
                                        <div class="font-size-sm text-muted font-weight-bold mt-1">{{ __('cms.total_discounts') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Records -->
        <div class="row">
            <!-- Latest Orders -->
            <div class="col-xl-6">
                <div class="card card-custom gutter-b">
                    <div class="card-header border-0">
                        <h3 class="card-title font-weight-bolder text-dark">{{ __('cms.latest_orders') }}</h3>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>{{ __('cms.order_number') }}</th>
                                        <th>{{ __('cms.customer') }}</th>
                                        <th>{{ __('cms.total') }}</th>
                                        <th>{{ __('cms.status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($latestOrders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}" class="text-dark-75 font-weight-bolder">
                                                #{{ $order->order_num }}
                                            </a>
                                        </td>
                                        <td>{{ $order->user?->full_name ?? 'N/A' }}</td>
                                        <td>{{ number_format($order->total, 2) }}</td>
                                        <td>
                                            <span class="badge badge-{{ $order->status_color }}">
                                                {{ __('cms.' . $order->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">{{ __('cms.no_records') }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest Users -->
            <div class="col-xl-6">
                <div class="card card-custom gutter-b">
                    <div class="card-header border-0">
                        <h3 class="card-title font-weight-bolder text-dark">{{ __('cms.latest_users') }}</h3>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>{{ __('cms.name') }}</th>
                                        <th>{{ __('cms.email') }}</th>
                                        <th>{{ __('cms.mobile') }}</th>
                                        <th>{{ __('cms.status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($latestUsers as $user)
                                    <tr>
                                        <td>
                                            <a href="{{ route('users.show', $user->id) }}" class="text-dark-75 font-weight-bolder">
                                                {{ $user->full_name }}
                                            </a>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <td>
                                            <span class="badge badge-{{ $user->status ? 'success' : 'danger' }}">
                                                {{ $user->status ? __('cms.active') : __('cms.inactive') }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">{{ __('cms.no_records') }}</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection