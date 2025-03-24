@extends('cms.parent')

@section('page-name', __('cms.orders'))
@section('main-page', __('cms.content_management'))
@section('sub-page', __('cms.orders'))
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
                <div class="card-header">
                    <div class="card-title">
                    <h2>{{ __('cms.order_details') }} (#{{ $data->order_num }})</h2>
                    </div>
                <div class="card-toolbar">
                    @can('Update-Employee-Order')
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusModal">
                        {{ __('cms.update_status') }}
                    </button>
                    @endcan
                </div>
            </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>{{ __('cms.order_number') }}</th>
                            <td>{{ $data->order_num }}</td>
                            <th>{{ __('cms.created_at') }}</th>
                            <td>{{ $data->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                        <tr>
                            <th>{{ __('cms.payment_method') }}</th>
                            <td><span class="badge badge-{{ $data->payment_method == 'cash' ? 'warning' : 'info' }}">
                                    {{ __('cms.' . $data->payment_method) }}
                                </span></td>
                            <th>{{ __('cms.payment_status') }}</th>
                            <td><span class="badge badge-{{ $data->payment_status == 'paid' ? 'success' : ($data->payment_status == 'failed' ? 'danger' : 'warning') }}">
                                    {{ __('cms.' . $data->payment_status) }}
                                </span></td>
                                </tr>
                        <tr>
                            <th>{{ __('cms.status') }}</th>
                            <td colspan="3"><span class="badge badge-{{ $data->status == 'completed' ? 'success' : ($data->status == 'cancelled' ? 'danger' : 'info') }}">
                                    {{ __('cms.' . $data->status) }}
                                </span></td>
                                </tr>
                        </table>
                </div>
            </div>
            </div>
            <!--end::Order details-->
            <!--begin::Customer details-->
            <div class="card card-flush py-4 flex-row-fluid">
                <div class="card-header">
                    <div class="card-title">
                    <h2>{{ __('cms.customer_details') }}</h2>
                </div>
            </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>{{ __('cms.customer_name') }}</th>
                            <td>{{ $data->user?->name ?? $data->user_full_name }}</td>
                            <th>{{ __('cms.customer_email') }}</th>
                            <td>{{ $data->user?->email ?? $data->user_email }}</td>
                                </tr>
                                <tr>
                            <th>{{ __('cms.customer_mobile') }}</th>
                            <td>{{ $data->user?->mobile ?? $data->user_mobile }}</td>
                            <th>{{ __('cms.customer_address') }}</th>
                            <td>{{ $data->user?->address ?? $data->user_address }}</td>
                                </tr>
                        </table>
                </div>
            </div>
            </div>
            <!--end::Customer details-->
        <!--begin::Order totals-->
        <div class="card card-flush py-4 flex-row-fluid">
                <div class="card-header">
                    <div class="card-title">
                    <h2>{{ __('cms.order_summary') }}</h2>
                </div>
            </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>{{ __('cms.subtotal') }}</th>
                            <td>{{ $data->subtotal }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('cms.shipping') }}</th>
                            <td>{{ $data->shipping }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('cms.discount') }}</th>
                            <td>{{ $data->discount }}</td>
                                </tr>
                        @if($data->coupon)
                        <tr>
                            <th>{{ __('cms.coupon_discount') }}</th>
                            <td>{{ $data->coupon_discount }}</td>
                                </tr>
                        @endif
                        <tr>
                            <th>{{ __('cms.total') }}</th>
                            <td><strong>{{ $data->total }}</strong></td>
                                </tr>
                        </table>
                </div>
            </div>
                    </div>

        @if($data->note)
        <div class="card card-flush py-4 flex-row-fluid">
            <div class="card-header">
                <div class="card-title">
                    <h2>{{ __('cms.order_note') }}</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                {{ $data->note }}
            </div>
        </div>
        @endif
        </div>
        <!--end::Order summary-->
        <!--begin::Tab content-->
        <div class="tab-content">
            <!--begin::Tab pane-->
            <div class="tab-pane fade active show" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                <!--begin::Orders-->
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                        <!--begin::Payment address-->
                        {{-- <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                            <!--begin::Background-->
                            <div class="position-absolute top-0 end-0 opacity-10 pe-none text-end">
                                <img src="{{asset('assets/media/icons/duotune/ecommerce/ecm001.svg')}}" class="w-175px">
                            </div>
                            <!--end::Background-->
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Payment Address</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                Unit 1/23 Hastings Road,
                                <br>Melbourne 3000,
                                <br>Victoria,
                                <br>Australia.
                            </div>
                            <!--end::Card body-->
                        </div> --}}
                        <!--end::Payment address-->
                        @if (!is_null($data->orderDate))
                            <!--begin::Shipping address-->
                            <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                <!--begin::Background-->
                                <div class="position-absolute top-0 end-0 opacity-10 pe-none text-end">
                                    <img src="{{ asset('assets/media/icons/duotune/ecommerce/ecm006.svg') }}"
                                        class="w-175px">
                                </div>
                                <!--end::Background-->
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Shipping Address</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    {{ $data->userAddress?->fullAddress ?? '' }},
                                    <br>{{ $data->orderDate?->title ?? '' }},
                                </div>
                                <!--end::Card body-->
                            </div>
                        @endif
                        <!--end::Shipping address-->
                    </div>
                    <!--begin::Product List-->
                    <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Order - {{ $data->order_num }}</h2>
                                                    </div>

                                                    </div>

                                                </div>
        <!--end::Product List-->
                                                </div>
    <!--end::Orders-->
                                            </div>
<!--end::Tab pane-->
<!--begin::Tab pane-->
<!--begin::Order Items-->
<div class="card card-flush py-4 flex-row-fluid">
    <div class="card-header">
        <div class="card-title">
            <h2>{{ __('cms.order_items') }}</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="min-w-175px">{{ __('cms.item') }}</th>
                        <th class="min-w-100px text-end">{{ __('cms.price') }}</th>
                        <th class="min-w-70px text-end">{{ __('cms.quantity') }}</th>
                        <th class="min-w-100px text-end">{{ __('cms.total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-bold text-gray-600">
                    @foreach ($data->items as $item)
                                            <tr>
                                                <!--begin::Product-->
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Thumbnail-->
                                @if($item->product?->image)
                                                        <a href="#" class="symbol symbol-50px">
                                    <span class="symbol-label" style="background-image:url({{ Storage::url($item->product->image) }});"></span>
                                                        </a>
                                @endif
                                                        <!--end::Thumbnail-->
                                                        <!--begin::Title-->
                                                        <div class="ms-5">
                                    <a href="#" class="fw-bolder text-gray-600 text-hover-primary">
                                        {{ $item->product?->tradeName ?? ''}}
                                                            </a>

                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                </td>
                                                <!--end::Product-->

                        <!--begin::Price-->
                        <td class="text-end">{{ $item->unit_price }}</td>
                        <!--end::Price-->

                                                <!--begin::Quantity-->
                        <td class="text-end">{{ $item->quantity }}</td>
                                                <!--end::Quantity-->
                                                
                                                <!--begin::Total-->
                        <td class="text-end">{{ $item->total_price }}</td>
                                                <!--end::Total-->
                                            </tr>
                                        @endforeach

                                        <!--begin::Subtotal-->
                                        <tr>
                        <td colspan="3" class="text-end">{{ __('cms.subtotal') }}</td>
                        <td class="text-end">{{ $data->subtotal }}</td>
                                        </tr>
                                        <!--end::Subtotal-->


                    @if($data->shipping > 0)
                                        <!--begin::Shipping-->
                                        <tr>
                        <td colspan="3" class="text-end">{{ __('cms.shipping') }}</td>
                        <td class="text-end">{{ $data->shipping }}</td>
                                        </tr>
                                        <!--end::Shipping-->
                    @endif

                    @if($data->discount > 0)
                    <!--begin::Discount-->
                    <tr>
                        <td colspan="3" class="text-end">{{ __('cms.discount') }}</td>
                        <td class="text-end">-{{ $data->discount }}</td>
                    </tr>
                    <!--end::Discount-->
                    @endif

                    @if($data->coupon_discount > 0)
                    <!--begin::Coupon-->
                    <tr>
                        <td colspan="3" class="text-end">{{ __('cms.coupon_discount') }}</td>
                        <td class="text-end">-{{ $data->coupon_discount }}</td>
                    </tr>
                    <!--end::Coupon-->
                    @endif

                                        <!--begin::Grand total-->
                                        <tr>
                        <td colspan="3" class="fs-3 text-dark fw-bolder text-end">{{ __('cms.total') }}</td>
                        <td class="text-dark fs-3 fw-boldest text-end">{{ $data->total }}</td>
                                        </tr>
                                        <!--end::Grand total-->
                                    </tbody>
                                </table>
        </div>
                            </div>
                        </div>
<!--end::Order Items-->
<!--end::Tab pane-->
</div>
<!--end::Tab content-->
</div>

@can('Update-Employee-Order')
<!-- Status Update Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">{{ __('cms.update_status') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="status">{{ __('cms.status') }}</label>
                    <select class="form-control" id="status">
                        <option value="pending" @selected($data->status == 'pending')>{{ __('cms.pending') }}</option>
                        <option value="processing" @selected($data->status == 'processing')>{{ __('cms.processing') }}</option>
                        <option value="completed" @selected($data->status == 'completed')>{{ __('cms.completed') }}</option>
                        <option value="cancelled" @selected($data->status == 'cancelled')>{{ __('cms.cancelled') }}</option>
                    </select>
                    </div>
                <div class="form-group">
                    <label for="note">{{ __('cms.note') }}</label>
                    <textarea class="form-control" id="note" rows="3">{{ $data->note }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('cms.close') }}</button>
                <button type="button" class="btn btn-primary" onclick="updateStatus()">{{ __('cms.save') }}</button>
            </div>
        </div>
    </div>
</div>
@endcan
@endsection

@section('scripts')
    <script>
    function updateStatus() {
        axios.put(`/cms/employee/orders/{{$data->id}}/status`, {
                status: document.getElementById('status').value,
            })
            .then(function(response) {
                toastr.success(response.data.message);
                $('#statusModal').modal('hide');
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            })
            .catch(function(error) {
                toastr.error(error.response.data.message);
            });
        }
    </script>
@endsection