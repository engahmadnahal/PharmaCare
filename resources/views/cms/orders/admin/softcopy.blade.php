@extends('cms.parent')

@section('page-name', __('cms.softcopy'))
@section('main-page', __('cms.order'))
@section('sub-page', __('cms.softcopy'))
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
    <div class="card mb-5 mb-xxl-8">
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap">
                <!--begin: Pic-->
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{ Storage::url($user->avater) ?? asset('assets/media/users/300_21.jpg') }}"
                            alt="image" style=" max-width: 155px; ">
                    </div>
                </div>
                <!--end::Pic-->
                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <a href="#"
                                    class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ $user->name }}</a>
                            </div>
                            <!--end::Name-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <a href="#"
                                    class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                    <span class="svg-icon svg-icon-4 me-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                                fill="black"></path>
                                            <path
                                                d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                                fill="black"></path>
                                        </svg>
                                    </span>
                                    {{ $user?->defaultAddress?->country?->name ?? '' }}
                                </a>
                                <a href="#"
                                    class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    {{ $user?->defaultAddress?->city?->name ?? '' }}</a>
                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                    {{ $user?->defaultAddress?->details ?? '' }}</a>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                        <!--begin::Actions-->
                        <div class="d-flex my-4">
                            @if (!$data->accepted)
                                <a data-toggle="modal" data-target="#accept_modal" class="btn btn-sm btn-danger me-2"
                                    id="kt_user_follow_button">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr012.svg-->
                                    <!--begin::Indicator-->
                                    <span class="indicator-label">{{ __('cms.accept_order') }}</span>
                                    <!--end::Indicator-->
                                </a>
                            @else
                                <span class="btn btn-info font-weight-bolder font-size-sm mr-2" data-toggle="modal"
                                    data-target="#order_status">{{ __('cms.order_status') }}</span>

                                <a data-toggle="modal" data-target="#accept_modal" class="btn btn-sm btn-success me-2"
                                    id="kt_user_follow_button">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr012.svg-->
                                    <!--begin::Indicator-->
                                    <span class="indicator-label">{{ __('cms.accept') }}</span>
                                    <!--end::Indicator-->
                                </a>
                            @endif

                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Title-->
                    <!--begin::Stats-->
                    <div class="d-flex flex-wrap flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap">
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <!--end::Svg Icon-->
                                        <div class="fs-2 fw-bolder counted" data-kt-countup="true"
                                            data-kt-countup-value="4500" data-kt-countup-prefix="$">{{ $data->receive }}
                                        </div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">{{ __('cms.receive') }}</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->

                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <!--end::Svg Icon-->
                                        <div class="fs-2 fw-bolder counted" data-kt-countup="true"
                                            data-kt-countup-value="4500" data-kt-countup-prefix="$">{{ $user->mobile }}
                                        </div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">{{ __('cms.mobile') }}</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">

                                        <!--end::Svg Icon-->
                                        <div class="fs-2 fw-bolder counted" data-kt-countup="true"
                                            data-kt-countup-value="80">{{ $user->email }}</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">{{ __('cms.email') }}</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <!--end::Stat-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->

            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                <!--begin::Number-->
                <div class="d-flex align-items-center">

                    <!--end::Svg Icon-->
                    <div class="fs-2 fw-bolder counted" data-kt-countup="true" data-kt-countup-value="80">
                        {{ $data->msg }}</div>
                </div>
                <!--end::Number-->
                <!--begin::Label-->
                <div class="fw-bold fs-6 text-gray-400">{{ __('cms.note') }}</div>
                <!--end::Label-->
            </div>
            <div>

            </div>
            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                <!--begin::Table head-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark"></span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                    </h3>
                    <div class="card-toolbar">



                        <a href="{{ route('order.softcopy.download', [$data->id, $user->id]) }}"
                            class="btn btn-light-primary me-3">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
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
                                        <a href="#"
                                            class="fw-bolder text-gray-600 text-hover-primary">#{{ ++$loop->index }}
                                        </a>
                                        {{-- <div class="fs-7 text-muted">{{$item->object->masterService->description}}</div> --}}
                                    </div>
                                    &numsp;
                                    <!--end::Title-->
                                    <!--begin::Thumbnail-->
                                    <a href="#" class="symbol symbol-50px">
                                        <span class="symbol-label"
                                            style="background-image:url({{ Storage::url($image->path) }});"></span>
                                    </a>
                                </div>
                            </td>
                            <td></td>
                            <td class="pr-0 text-right">
                                <a href="{{ Storage::url($image->path) }}" target="_blanck"
                                    class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                    <span class="svg-icon svg-icon-md svg-icon-primary">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
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

                    <!--begin::Products-->

                </tbody>
                <!--end::Table head-->
            </table>
        </div>
    </div>



    @if ($data->accepted)

        <div class="modal fade" id="order_status" tabindex="-1" role="dialog" aria-labelledby="order_status"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ __('cms.order_status') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>

                    
                    <div class="modal-body">
                        <div class="form-group row mt-4">
                            <label class="col-3 col-form-label">{{ __('cms.order_status') }}:<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-4 col-md-9 col-sm-12">
                                <div class="dropdown bootstrap-select form-control dropup">
                                    <select class="form-control selectpicker" data-size="7" id="order_status_id"
                                        title="Choose one of the following..." tabindex="null" data-live-search="true">
                                        @foreach ($orderStatus as $status)
                                            <option value="{{ $status->id }}" @selected($status->id == $order?->order_status_id && $order?->status != 'finsh')>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                        <option value="finsh" @selected($order?->status == 'finsh')>
                                            {{ __('cms.finsh_order') }}
                                        </option>
                                    </select>
                                </div>
                                <span class="form-text text-muted">{{ __('cms.please_select') }}
                                    {{ __('cms.order_status') }}</span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="changeStatus({{ $order?->id }})"
                            class="btn btn-light-primary font-weight-bold">{{ __('cms.save') }}</button>

                        <button type="button" class="btn btn-light-primary font-weight-bold"
                            data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    @endif

    <div class="modal fade" id="accept_modal" tabindex="-1" role="dialog" aria-labelledby="accept_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('cms.accept_order') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <x-input type="text" id="price" value="{{ $data->price }}"
                        name="{{ __('cms.price') }} / {{ $user->currencyCode }}" :disabled="!is_null($data->note_admin_ar)" />
                    <x-textarea type="text" id="note_admin_ar" value="{{ $data->note_admin_ar }}"
                        name="{{ __('cms.note_ar') }}" :disabled="!is_null($data->note_admin_ar)" />
                    <x-textarea type="text" id="note_admin_en" value="{{ $data->note_admin_en }}"
                        name="{{ __('cms.note_en') }}" dir="ltr" :disabled="!is_null($data->note_admin_ar)" />
                        @if (!$data->accepted)
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{ __('cms.order_status') }}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="order_status_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($orderStatus as $status)
                                        <option value="{{ $status->id }}" @selected($status->id == $order?->order_status_id && $order?->status != 'finsh')>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                    <option value="finsh" @selected($order?->status == 'finsh')>
                                        {{ __('cms.finsh_order') }}
                                    </option>
                                </select>
                            </div>
                            <span class="form-text text-muted">{{ __('cms.please_select') }}
                                {{ __('cms.order_status') }}</span>
                        </div>
                    </div>
                    @endif


                </div>
                <div class="modal-footer">

                    @if (!$data->accepted)
                        <button type="button" onclick="accept()" class="btn btn-light-primary font-weight-bold"
                            data-dismiss="modal">Accept</button>
                    @endif
                    <button type="button" class="btn btn-light-primary font-weight-bold"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection






@section('scripts')
    <script>
        @if ($data->accepted)
            function changeStatus(orderId) {
                let data = {
                    order_id: orderId,
                    order_status: $('#order_status_id').val()
                }

                store('/cms/admin/order/change-status', data);
            }
        @endif

        
        function accept() {
            let data = {
                note_admin_ar: document.getElementById('note_admin_ar').value,
                note_admin_en: document.getElementById('note_admin_en').value,
                price: document.getElementById('price').value,
                @if(!$data->accepted)
                order_status: $('#order_status_id').val()
                @endif

            };
            store('/cms/admin/order/softcopy/{{ $data->id }}/accepted', data);
        }
    </script>
@endsection
