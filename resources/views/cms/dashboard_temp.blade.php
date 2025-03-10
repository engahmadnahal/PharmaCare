@extends('cms.parent')


@section('page-name',__('cms.dashboard'))
@section('main-page',__('cms.app_name'))
@section('sub-page',__('cms.dashboard'))
@section('content')
<!--begin::Dashboard-->
<!--begin::Row-->

@if (auth('admin')->check())
    @include('cms.indexes.admin')
@endif

@if (auth('employee')->check())
    @include('cms.indexes.employee')
@endif


<!--end::Dashboard-->
@endsection

@section('scripts')

<!-- @if (auth('admin')->check())
<script>
    "use strict";

    // Class definition
    var KTWidgets2 = function() {
        // Private properties


        var _initChartsWidget3 = function(id = null,data = null) {
            var element = document.getElementById(id);

            if (!element) {
                return;
            }

            var options = {
                series: [{
                    name: 'Net Profit',
                    data: data
                }],
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {

                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [KTApp.getSettings()['colors']['theme']['base']['info']]
                },
                xaxis: {
                    categories: ['Jab','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug','Sept','Oct','Nov','Dec'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        }
                    },
                    crosshairs: {
                        position: 'front',
                        stroke: {
                            color: KTApp.getSettings()['colors']['theme']['base']['info'],
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    },
                    y: {
                        formatter: function(val) {
                            return "$" + val + " thousands"
                        }
                    }
                },
                colors: [KTApp.getSettings()['colors']['theme']['light']['info']],
                grid: {
                    borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                markers: {
                    //size: 5,
                    //colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
                    strokeColor: KTApp.getSettings()['colors']['theme']['base']['info'],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        }

        // Public methods
        return {
            init: function() {
                _initChartsWidget3('kt_charts_user',{{$usersChart}});
                _initChartsWidget3('kt_charts_orders',{{$orderChart}});
            }
        }
    }();

    // Webpack support
    if (typeof module !== 'undefined') {
        module.exports = KTWidgets2;
    }

    jQuery(document).ready(function() {
        KTWidgets2.init();
    });
</script>
@endif


@if (auth('employee')->check())
<script>
    "use strict";

    // Class definition
    var KTWidgets2 = function() {
        // Private properties


        var _initChartsWidget3 = function(id = null,data = null) {
            var element = document.getElementById(id);

            if (!element) {
                return;
            }

            var options = {
                series: [{
                    name: 'Net Profit',
                    data: data
                }],
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {

                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [KTApp.getSettings()['colors']['theme']['base']['info']]
                },
                xaxis: {
                    categories: ['Jab','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug','Sept','Oct','Nov','Dec'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        }
                    },
                    crosshairs: {
                        position: 'front',
                        stroke: {
                            color: KTApp.getSettings()['colors']['theme']['base']['info'],
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    },
                    y: {
                        formatter: function(val) {
                            return "$" + val + " thousands"
                        }
                    }
                },
                colors: [KTApp.getSettings()['colors']['theme']['light']['info']],
                grid: {
                    borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                markers: {
                    //size: 5,
                    //colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
                    strokeColor: KTApp.getSettings()['colors']['theme']['base']['info'],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        }

        // Public methods
        return {
            init: function() {
                _initChartsWidget3('kt_charts_orders',{{$orderChart}});
            }
        }
    }();

    // Webpack support
    if (typeof module !== 'undefined') {
        module.exports = KTWidgets2;
    }

    jQuery(document).ready(function() {
        KTWidgets2.init();
    });
</script>
@endif -->


@endsection