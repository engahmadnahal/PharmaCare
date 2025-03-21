@extends('cms.parent')

@section('page-name', __('cms.products'))
@section('main-page', __('cms.pharmacy_management'))
@section('sub-page', __('cms.products'))
@section('page-name-small', __('cms.index'))

@section('styles')

@endsection

@section('content')
<!--begin::Advance Table Widget 5-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{ __('cms.products') }}</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
        </h3>
        @can('Create-Employee-Product')
        <div class="card-toolbar">
            <a href="{{ route('cms.employee.products.create') }}"
                class="btn btn-info font-weight-bolder font-size-sm mr-2">{{ __('cms.create') }}</a>
        </div>
        @endcan
    </div>
    <!--end::Header-->


    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_2">
                <thead>
                    <tr class="text-uppercase">
                        <th class="pl-0" style="min-width: 100px">{{ __('cms.trade_name') }}</th>
                        <th class="pl-0" style="min-width: 100px">{{ __('cms.scientific_name') }}</th>
                        <th class="pl-0" style="min-width: 100px">{{ __('cms.basic_price') }}</th>
                        <th class="pl-0" style="min-width: 100px">{{ __('cms.retail_price') }}</th>
                        <th style="min-width: 150px">{{ __('cms.expiration_date') }}</th>
                        <th style="min-width: 150px">{{ __('cms.status') }}</th>
                        @canany(['Update-Employee-Product', 'Delete-Employee-Product'])
                        <th class="pr-0 text-right" style="min-width: 160px">{{ __('cms.actions') }}</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $product)
                    <tr>

                        <td class="pl-0">
                            <a
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $product->tradeName }}</a>
                        </td>

                        <td class="pl-0">
                            <a
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $product->scientificName }}</a>
                        </td>


                        <td class="pl-0">
                            <a
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $product->basic_price }}</a>
                        </td>

                        <td class="pl-0">
                            <a
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $product->retail_price }}</a>
                        </td>
                        <td class="pl-0">
                            <a
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $product->expiration_date }}</a>
                        </td>


                        <td>
                            <span
                                class="label label-lg @if ($product->available_without_prescription) label-light-success @else label-light-warning @endif label-inline">{{ $product->available_without_prescription ? __('cms.available_without_prescription') : __('cms.available_with_prescription') }}</span>
                        </td>
                        <td class="pr-0 text-right">
                            @can('Create-Employee-Product')
                            <a href="{{ route('cms.employee.products.show', $product->id) }}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <span class="svg-icon svg-icon-md svg-icon-primary">

                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-bar3.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <rect fill="#000000" opacity="0.3" x="7" y="4"
                                                width="3" height="13" rx="1.5" />
                                            <rect fill="#000000" opacity="0.3" x="12" y="9"
                                                width="3" height="8" rx="1.5" />
                                            <path
                                                d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                            <rect fill="#000000" opacity="0.3" x="17" y="11"
                                                width="3" height="6" rx="1.5" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            @endcan


                            @can('Update-Employee-Product')
                            <a href="{{ route('cms.employee.products.edit', $product->id) }}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24">
                                            </rect>
                                            <path
                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)">
                                            </path>
                                            <path
                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            @endcan
                            @can('Delete-Employee-Product')
                            <a href="#" onclick="performcityDestroy('{{ $product->id }}', this)"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                        viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                fill="#000000" fill-rule="nonzero" />
                                            <path
                                                d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
            </table>
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
    function performcityDestroy(id, reference) {
        confirmDestroy('/cms/employee/products', id, reference);
    }
</script>
@endsection