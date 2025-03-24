@extends('cms.parent')

@section('page-name', __('cms.dashboard'))
@section('main-page', __('cms.content_management'))
@section('sub-page', __('cms.dashboard'))
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.css" rel="stylesheet">
@endsection
@section('content')
<div class="card card-custom gutter-b p-5">
    <!-- Profile Summary -->
    <div class="card card-custom mb-5">
        <div class="card-body pt-4">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                    <div class="symbol-label" style="background-image:url('{{ auth()->user()->image_url }}')"></div>
                </div>
                <div>
                    <h4 class="font-weight-bold">{{ auth()->user()->name }}</h4>
                    <div class="text-muted">{{ auth()->user()->email }}</div>
                    <div class="mt-2">
                        <span class="label label-light-primary font-weight-bold label-inline">{{ auth()->user()->roles->first()?->nam ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Stats -->
    <div class="row">
        <!-- Orders Stats -->
        <div class="col-xl-3">
            <div class="card card-custom bg-primary card-stretch gutter-b">
                <div class="card-body">
                    <span class="svg-icon svg-icon-white svg-icon-3x">
                        <!-- Shopping Cart Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M21 10H3" stroke="white" stroke-width="2" stroke-linecap="round" />
                            <path d="M5 6L3 10V20C3 20.5523 3.44772 21 4 21H20C20.5523 21 21 20.5523 21 20V10L19 6" stroke="white" stroke-width="2" />
                            <path d="M15 6C15 4.34315 13.6569 3 12 3C10.3431 3 9 4.34315 9 6" stroke="white" stroke-width="2" />
                        </svg>
                    </span>
                    <div class="text-white font-weight-bolder font-size-h2 mt-3">{{ $totalOrders }}</div>
                    <a href="#" class="text-white font-weight-bold font-size-lg mt-1">{{ __('cms.total_orders') }}</a>
                </div>
            </div>
        </div>

        <!-- Products Stats -->
        <div class="col-xl-3">
            <div class="card card-custom bg-warning card-stretch gutter-b">
                <div class="card-body">
                    <span class="svg-icon svg-icon-white svg-icon-3x">
                        <!-- Products Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M16 7C16 5.93913 15.5786 4.92172 14.8284 4.17157C14.0783 3.42143 13.0609 3 12 3C10.9391 3 9.92172 3.42143 9.17157 4.17157C8.42143 4.92172 8 5.93913 8 7" stroke="white" stroke-width="2"/>
                            <path d="M3.5 7H20.5L19 21H5L3.5 7Z" stroke="white" stroke-width="2"/>
                            <path d="M8 10V11" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            <path d="M16 10V11" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </span>
                    <div class="text-white font-weight-bolder font-size-h2 mt-3">{{ $totalProducts }}</div>
                    <a href="#" class="text-white font-weight-bold font-size-lg mt-1">{{ __('cms.total_products') }}</a>
                </div>
            </div>
        </div>

        <!-- Coupons Stats -->
        <div class="col-xl-3">
            <div class="card card-custom bg-info card-stretch gutter-b">
                <div class="card-body">
                    <span class="svg-icon svg-icon-white svg-icon-3x">
                        <!-- Coupon Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M21 5H3C2.44772 5 2 5.44772 2 6V18C2 18.5523 2.44772 19 3 19H21C21.5523 19 22 18.5523 22 18V6C22 5.44772 21.5523 5 21 5Z" stroke="white" stroke-width="2" />
                            <path d="M16 5V19" stroke="white" stroke-width="2" stroke-dasharray="3 3" />
                        </svg>
                    </span>
                    <div class="text-white font-weight-bolder font-size-h2 mt-3">{{ $totalCoupons }}</div>
                    <a href="#" class="text-white font-weight-bold font-size-lg mt-1">{{ __('cms.total_coupons') }}</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mt-5">
        <!-- Orders Chart -->
        <div class="col-xl-6">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">{{ __('cms.orders_chart') }}</h3>
                </div>
                <div class="card-body">
                    <div id="orders_chart"></div>
                </div>
            </div>
        </div>

        <!-- Users Chart -->
        <div class="col-xl-6">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">{{ __('cms.users_chart') }}</h3>
                </div>
                <div class="card-body">
                    <div id="users_chart"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row mt-5">
        <!-- Recent Orders -->
        <div class="col-xl-6">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">{{ __('cms.recent_orders') }}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('cms.order_number') }}</th>
                                    <th>{{ __('cms.customer') }}</th>
                                    <th>{{ __('cms.amount') }}</th>
                                    <th>{{ __('cms.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->order_num }}</td>
                                    <td>{{ $order->user_full_name }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td>
                                        <span class="label label-{{ $order->status_color }} label-inline">
                                            {{ __('cms.' . $order->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Products -->
        <div class="col-xl-6">
            <div class="card card-custom">
                <div class="card-header">
                    <h3 class="card-title">{{ __('cms.recent_products') }}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('cms.product') }}</th>
                                    <th>{{ __('cms.price') }}</th>
                                    <th>{{ __('cms.stock') }}</th>
                                    <th>{{ __('cms.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentProducts as $product)
                                <tr>
                                    <td>{{ $product->trade_name }}</td>
                                    <td>{{ $product->basic_price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        <span class="label label-{{ $product->available_without_prescription ? 'success' : 'danger' }} label-inline">
                                            {{ $product->available_without_prescription ? __('cms.available_without_prescription') : __('cms.available_with_prescription') }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0/dist/apexcharts.min.js"></script>
<script>
    // Orders Chart Configuration
    var ordersOptions = {
        series: [{
            name: '{{ __("cms.orders") }}',
            data: @json($orderChartData)
        }],
        chart: {
            type: 'area',
            height: 350,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            area: {
                fillTo: 'end'
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        xaxis: {
            type: 'datetime',
            categories: @json($orderChartLabels),
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: '#B5B5C3',
                    fontSize: '12px'
                },
                format: 'dd MMM'
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#B5B5C3',
                    fontSize: '12px'
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.9,
                stops: [0, 90, 100]
            }
        },
        tooltip: {
            theme: 'dark',
            y: {
                formatter: function (val) {
                    return val + " {{ __('cms.orders') }}"
                }
            }
        },
        colors: ['#1BC5BD']
    };

    // Initialize Orders Chart
    var ordersChart = new ApexCharts(document.querySelector("#orders_chart"), ordersOptions);
    ordersChart.render();

    // Users Chart Configuration (similar setup)
    var usersOptions = {
        series: [{
            name: '{{ __("cms.users") }}',
            data: @json($userChartData)
        }],
        chart: {
            type: 'area',
            height: 350,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            area: {
                fillTo: 'end'
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        xaxis: {
            type: 'datetime',
            categories: @json($userChartLabels),
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: '#B5B5C3',
                    fontSize: '12px'
                },
                format: 'dd MMM'
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#B5B5C3',
                    fontSize: '12px'
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.9,
                stops: [0, 90, 100]
            }
        },
        tooltip: {
            theme: 'dark',
            y: {
                formatter: function (val) {
                    return val + " {{ __('cms.users') }}"
                }
            }
        },
        colors: ['#3699FF']
    };

    // Initialize Users Chart
    var usersChart = new ApexCharts(document.querySelector("#users_chart"), usersOptions);
    usersChart.render();
</script>
@endsection