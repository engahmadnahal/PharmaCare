@extends('cms.parent')

@section('page-name', __('cms.order_status_report'))
@section('main-page', __('cms.reports'))
@section('sub-page', __('cms.order_status_report'))
@section('page-name-small', __('cms.index'))

@section('styles')

@endsection

@section('content')
    <!--begin::Advance Table Widget 5-->
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">{{ __('cms.order_status_report') }}</span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
            </h3>
            <div class="card-toolbar">

                <div class="actions" style="width: 100%;display: flex;justify-content: end;">

                    <a href="{{ route('reports.order.status.excel') }}"
                        class="btn btn-info font-weight-bolder font-size-sm mr-2">{{ __('cms.export_excel') }}</a>

                    <a onclick="performFilter()" class="btn btn-info font-weight-bolder font-size-sm mr-2"
                        style="
                            fill: #fff;
                        ">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                            viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z" />
                        </svg>
                    </a>
                </div>


                <div class="row " style="justify-content: end; width: 100%;">

                    <div class="col-3 form-group  mt-4">
                        {{-- <label class="col- col-form-label">{{ __('cms.order_status_in_user') }}:<span
                            class="text-danger">*</span></label> --}}
                        <div class="dropdown bootstrap-select form-control dropup">
                            <select class="form-control selectpicker" data-size="7" id="order_status_in_user"
                                title="Choose one of the following..." tabindex="null" data-live-search="true">
                                <option value="" @selected(request()->order_status_in_user == '')>--</option>
                                @foreach ($orderStatus as $status)
                                    <option value="{{ $status->id }}" @selected($status->id == request()->order_status_in_user)>{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="form-text text-muted">{{ __('cms.please_select') }}
                            {{ __('cms.order_status_in_user') }}</span>
                    </div>

                    <div class="col-3 form-group  mt-4">
                        {{-- <label class="col- col-form-label">{{ __('cms.order_status_in_user') }}:<span
                            class="text-danger">*</span></label> --}}
                        <div class="dropdown bootstrap-select form-control dropup">
                            <select class="form-control selectpicker" data-size="7" id="order_status_in_studio"
                                title="Choose one of the following..." tabindex="null" data-live-search="true">
                                <option value="" @selected(request()->order_status_in_studio == '')>--</option>
                                <option value="wait" @selected(request()->order_status_in_studio == 'wait')>wait</option>
                                <option value="underway" @selected(request()->order_status_in_studio == 'underway')>underway</option>
                                <option value="finsh" @selected(request()->order_status_in_studio == 'finsh')>finsh</option>
                            </select>
                            <span class="form-text text-muted">{{ __('cms.please_select') }}
                                {{ __('cms.order_status_in_studio') }}</span>
                        </div>
                    </div>

                    <div class="form-group col-3 mt-4">
                        <input type="date" class="form-control" id="from" placeholder="{{ __('cms.from') }}"
                            value="{{ request()->from }}" />
                        <span class="form-text text-muted">{{ __('cms.please_enter') }} {{ __('cms.from') }}</span>
                    </div>

                    <div class="form-group  mt-4">
                        <input type="date" class="form-control" id="to" placeholder="{{ __('cms.to') }}"
                            dir="ltr" value="{{ request()->to }}" />
                        <span class="form-text text-muted">{{ __('cms.please_enter') }} {{ __('cms.to') }}</span>
                    </div>



                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-0">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_2">
                        <thead>
                            <tr class="text-uppercase">
                                <th style="max-width: 150px">{{ __('cms.order_number') }}</th>
                                <th style="max-width: 120px">{{ __('cms.order_services') }}</th>
                                <th style="max-width: 120px">{{ __('cms.order_date') }}</th>
                                <th style="max-width: 120px">{{ __('cms.order_amount') }}</th>
                                <th style="max-width: 120px">{{ __('cms.customer_name') }}</th>
                                <th style="max-width: 120px">{{ __('cms.customer_mobile') }}</th>
                                <th style="max-width: 120px">{{ __('cms.studio') }}</th>
                                {{-- <th style="min-width: 120px">{{ __('cms.order_status_in_user') }}</th>
                                <th style="min-width: 120px">{{ __('cms.order_status_in_studio') }}</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $order)
                                <tr>
                                    <td class="pl-0">
                                        <span
                                            class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $order->order_num }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $order->servicesType ?? '' }}</span>
                                    </td>
                                    <td>
                                        <span
                                            class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ Carbon::parse($order->created_at)->format('Y/m/d') }}</span>
                                    </td>

                                    <td>
                                        <span
                                            class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $order->cost }} {{$order->currency?->code}}</span>
                                    </td>

                                    <td>
                                        <span
                                            class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $order->user?->name }}</span>
                                    </td>

                                    <td>
                                        <span
                                            class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $order->user?->mobile }}</span>
                                    </td>

                                    <td>
                                        <span
                                            class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $order->studioSendOrder?->name ?? '-' }}</span>
                                    </td>

                                    {{-- <td>
                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg"></span>
                                    </td>

                                    <td>
                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg"></span>
                                    </td> --}}

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
        <!--end::Advance Table Widget 5-->
    @endsection

    @section('scripts')
        <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
        <script>
            function performFilter() {
                let from = $('#from').val(),
                    to = $('#to').val(),
                    statusUser = $('#order_status_in_user').val(),
                    statusStudio = $('#order_status_in_studio').val();

                window.location.href =
                    `{{ route('reports.order.status') }}?order_status_in_user=${statusUser}&order_status_in_studio=${statusStudio}&from=${from}&to=${to}`;
            }
        </script>
    @endsection
