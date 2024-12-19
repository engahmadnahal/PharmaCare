@extends('cms.parent')

@section('page-name',__('cms.request_studio'))
@section('main-page',__('cms.hr'))
@section('sub-page',__('cms.request_studio'))
@section('page-name-small',__('cms.index'))

@section('styles')

@endsection

@section('content')
<!--begin::Advance Table Widget 5-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{__('cms.request_studio')}}</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
        </h3>
        <div class="card-toolbar">
            
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
                        <th style="min-width: 120px">{{__('cms.full_name')}}</th>
                        <th style="min-width: 150px">{{__('cms.mobile')}}</th>
                        <th style="min-width: 150px">{{__('cms.email')}}</th>
                        <th style="min-width: 130px">{{__('cms.account_status')}}</th>
                        <th style="min-width: 130px">{{__('cms.accepted_status')}}</th>
                        <th class="pr-0 text-right" style="min-width: 160px">{{__('cms.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $std)
                    <tr>
                        <td class="pl-0">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$std->name}}</a>
                        </td>
                        <td>
                            <span
                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$std->mobile}}</span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$std->email}}</span>
                        </td>
                       
                        <td>
                            <span
                                class="label label-lg @if($std->active) label-light-success @else label-light-danger @endif label-inline">{{$std->active_key}}</span>
                        </td>

                        <td>
                            <span
                                class="label label-lg @if($std->isAcceptable == 'accept') label-light-success @elseif($std->isAcceptable == 'wait') label-light-warning @else label-light-danger @endif label-inline">{{$std->is_acceptable_key}}</span>
                        </td>

                        <td class="pr-0 text-right">


                            <a href="#" onclick="performAccept('{{$std->id}}', this)"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                    <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr012.svg-->
<span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
    <path opacity="0.3" d="M10 18C9.7 18 9.5 17.9 9.3 17.7L2.3 10.7C1.9 10.3 1.9 9.7 2.3 9.3C2.7 8.9 3.29999 8.9 3.69999 9.3L10.7 16.3C11.1 16.7 11.1 17.3 10.7 17.7C10.5 17.9 10.3 18 10 18Z" fill="currentColor"/>
    <path d="M10 18C9.7 18 9.5 17.9 9.3 17.7C8.9 17.3 8.9 16.7 9.3 16.3L20.3 5.3C20.7 4.9 21.3 4.9 21.7 5.3C22.1 5.7 22.1 6.30002 21.7 6.70002L10.7 17.7C10.5 17.9 10.3 18 10 18Z" fill="currentColor"/>
    </svg>
    <!--end::Svg Icon-->
                                </span>
                            </a>

                            <a href="#" onclick="performInAccept('{{$std->id}}', this)"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M6 19.7C5.7 19.7 5.5 19.6 5.3 19.4C4.9 19 4.9 18.4 5.3 18L18 5.3C18.4 4.9 19 4.9 19.4 5.3C19.8 5.7 19.8 6.29999 19.4 6.69999L6.7 19.4C6.5 19.6 6.3 19.7 6 19.7Z" fill="currentColor"/>
                                    <path d="M18.8 19.7C18.5 19.7 18.3 19.6 18.1 19.4L5.40001 6.69999C5.00001 6.29999 5.00001 5.7 5.40001 5.3C5.80001 4.9 6.40001 4.9 6.80001 5.3L19.5 18C19.9 18.4 19.9 19 19.5 19.4C19.3 19.6 19 19.7 18.8 19.7Z" fill="currentColor"/>
                                    </svg>
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
    function performInAccept(id,reference) {
        store('/cms/admin/request-studio/'+id+'/inaccept');
    }
    function performAccept(id,reference) {
        store('/cms/admin/request-studio/'+id+'/accept');
    }
</script>
@endsection