@extends('cms.parent')

@section('page-name',__('cms.order'))
@section('main-page',__('cms.shop_content_management'))
@section('sub-page',__('cms.softcopy'))
@section('page-name-small',__('cms.index'))

@section('styles')

@endsection

@section('content')
<!--begin::Advance Table Widget 5-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{__('cms.softcopy')}}</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
        </h3>
        {{-- @can('Create-Order') --}}
        <div class="card-toolbar">
            {{-- 
                <a href="{{route('tradmarks.exportExcel')}}"
                class="btn btn-info font-weight-bolder font-size-sm mr-2">{{__('cms.export_excel')}}</a> --}}
        </div>
        {{-- @endcan --}}
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
                        <th>#</th>
                        <th style="min-width: 150px">{{__('cms.user_name')}}</th>
                        <th style="min-width: 150px">{{__('cms.paid_status')}}</th>
                        <th style="min-width: 150px">{{__('cms.message')}}</th>
                        <th style="min-width: 150px">{{__('cms.craeted_at')}}</th>
                        <th style="min-width: 150px">{{__('cms.status')}}</th>
                        
                        <th class="pr-0 text-right" style="min-width: 160px">{{ __('cms.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $order)
                    <tr>

                        <td class="pl-0">
                            {{++$loop->index}}
                        </td>

                       

                        <td>
                            <a href="#" class="label label-lg label-light-success label-inline">{{$order->user->name
                                ?? ''}}</a>
                        </td>


                        <td class="pl-0">
                            <a 
                                         class="label label-lg {{$order->order?->paid_status ? 'label-light-success' : 'label-light-danger'}} label-inline">{{ $order->order?->paid_status ? 'Paid' : 'NotPaid' }}</a>
                         </td>

                         
                        <td>
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$order->msg
                                ?? ''}}</a>
                        </td>

                        <td>
                            <span
                                class="label label-lg label-light-info label-inline">{{$order->created_at->format('Y-m-d')}}</span>
                        </td>
                       
                        <td>
                            <span
                                class="label label-lg  {{$order->accepted ? 'label-light-success' : 'label-light-danger'}} label-inline">{{$order->accepteKey}}</span>
                        </td>
                        <td class="pr-0 text-right">
                            <a href="{{route('order.softcopy.detials',$order->id)}}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none">
                                        <g stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd">
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
<script src="{{asset('assets/js/pages/widgets.js')}}"></script>
<script>

</script>
@endsection