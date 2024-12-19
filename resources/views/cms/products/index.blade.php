@extends('cms.parent')

@section('page-name', __('cms.products'))
@section('main-page', __('cms.shop_content_management'))
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
            @can('Create-Product')
                <div class="card-toolbar">
                    <a href="{{ route('products.create') }}"
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
                            {{-- <th class="pl-0" style="min-width: 100px">id</th> --}}
                            <th class="pl-0" style="min-width: 100px">{{ __('cms.name_ar') }}</th>
                            <th class="pl-0" style="min-width: 100px">{{ __('cms.name_en') }}</th>
                            <th class="pl-0" style="min-width: 100px">{{ __('cms.price') }}</th>
                            <th style="min-width: 150px">{{ __('cms.item_count') }}</th>
                            <th style="min-width: 150px">{{ __('cms.storehouse') }}</th>
                            <th style="min-width: 150px">{{ __('cms.type') }}</th>
                            <th style="min-width: 150px">{{ __('cms.active') }}</th>
                            @canany(['Update-Product', 'Delete-Product'])
                                <th class="pr-0 text-right" style="min-width: 160px">{{ __('cms.actions') }}</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $product)
                            <tr>
                             
                                <td class="pl-0">
                                    <a
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $product->name_ar }}</a>
                                </td>

                                <td class="pl-0">
                                    <a
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $product->name_en }}</a>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#c_{{ $product->id }}_translations"
                                        class="btn btn-light-primary font-weight-bolder font-size-sm">({{ $product->price->count() }})</a>
                                    <div class="modal fade" id="c_{{ $product->id }}_translations" tabindex="-1"
                                        role="dialog" aria-labelledby="c_{{ $product->id }}_translations"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('cms.currency') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <i aria-hidden="true" class="ki ki-close"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">{{ __('cms.currency') }}</th>
                                                                <th scope="col">{{ __('cms.price') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($product->price as $p)
                                                                <tr>
                                                                    <td>
                                                                        <span
                                                                            class="text-info font-weight-bolder d-block font-size-lg">{{ $p->currency->name }}</span>
                                                                    </td>
                                                                    <td>
                                                                        <span
                                                                            class="text-info font-weight-bolder d-block font-size-lg">{{ $p->price }}
                                                                            {{ $p->currency->code }}</span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-primary font-weight-bold"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="pl-0">
                                    <a
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $product->num_items }}</a>
                                </td>
                                <td class="pl-0">
                                    <a
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $product->storehouse->name }}</a>
                                </td>

                                <td class="pl-0">
                                    <a
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $product->type }}</a>
                                </td>

                                <td>
                                    <span
                                        class="label label-lg @if ($product->active) label-light-success @else label-light-warning @endif label-inline">{{ $product->active_key }}</span>
                                </td>
                                <td class="pr-0 text-right">


                                    @can('Create-Product')
                                        <a href="{{ route('products.show', $product->id) }}"
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
                                  
                                        @if ($product->type == 'studio')
                                            <a href="{{ route('products.distribution', $product->id) }}"
                                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Cart1.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                        viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path
                                                                d="M18.1446364,11.84388 L17.4471627,16.0287218 C17.4463569,16.0335568 17.4455155,16.0383857 17.4446387,16.0432083 C17.345843,16.5865846 16.8252597,16.9469884 16.2818833,16.8481927 L4.91303792,14.7811299 C4.53842737,14.7130189 4.23500006,14.4380834 4.13039941,14.0719812 L2.30560137,7.68518803 C2.28007524,7.59584656 2.26712532,7.50338343 2.26712532,7.4104669 C2.26712532,6.85818215 2.71484057,6.4104669 3.26712532,6.4104669 L16.9929851,6.4104669 L17.606173,3.78251876 C17.7307772,3.24850086 18.2068633,2.87071314 18.7552257,2.87071314 L20.8200821,2.87071314 C21.4717328,2.87071314 22,3.39898039 22,4.05063106 C22,4.70228173 21.4717328,5.23054898 20.8200821,5.23054898 L19.6915238,5.23054898 L18.1446364,11.84388 Z"
                                                                fill="#000000" opacity="0.3" />
                                                            <path
                                                                d="M6.5,21 C5.67157288,21 5,20.3284271 5,19.5 C5,18.6715729 5.67157288,18 6.5,18 C7.32842712,18 8,18.6715729 8,19.5 C8,20.3284271 7.32842712,21 6.5,21 Z M15.5,21 C14.6715729,21 14,20.3284271 14,19.5 C14,18.6715729 14.6715729,18 15.5,18 C16.3284271,18 17,18.6715729 17,19.5 C17,20.3284271 16.3284271,21 15.5,21 Z"
                                                                fill="#000000" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </a>
                                        @endif

                                    @endcan


                                    @can('Update-Product')
                                        <a href="{{ route('products.edit', $product->id) }}"
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
                                    @can('Delete-Product')
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
            confirmDestroy('/cms/admin/products', id, reference);
        }

        function performTranslationDestroy(id, reference) {
            confirmDestroy('/cms/admin/products/translations', id, reference);
        }
    </script>
@endsection
