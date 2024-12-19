@extends('cms.parent')

@section('page-name',__('cms.contact_requests'))
@section('main-page',__('cms.client_services'))
@section('sub-page',__('cms.contact_requests'))
@section('page-name-small',__('cms.index'))

@section('styles')

@endsection

@section('content')
<!--begin::Advance Table Widget 5-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{__('cms.contact_requests')}}</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">--</span>
        </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_2">
                <thead>
                    <tr class="text-uppercase">
                        <th style="min-width: 50px">{{__('cms.name')}}</th>
                        {{-- <th style="min-width: 40px">phone</th> --}}
                        <th style="min-width: 160px">{{__('cms.message')}}</th>
                        <th class="pr-0 text-right" style="min-width: 100px">{{__('cms.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($complaints as $complaint)
                    <tr>
                        <td class="pl-0">
                            <div>
                                <span
                                    class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$complaint->full_name}}</span>
                                <span class="text-muted font-weight-bold d-block">{{$complaint->mobile}}</span>
                            </div>
                        </td>
                        <td class="pl-3">
                            <div>
                                <span
                                    class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$complaint->title}}</span>
                                <span class="text-muted font-weight-bold d-block">{{$complaint->content}}</span>
                            </div>
                        </td>
                        <td class="pr-0 text-right">
                            <a href="#" onclick="performDestroy('{{$complaint->id}}', this)"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--end::Table-->
        <div class="row">
            <div class="text-center">
                <ul>
                    {{$complaints->links()}}
                </ul>
            </div>
        </div>
    </div>
    <!--end::Body-->

</div>
<!--end::Advance Table Widget 5-->
@endsection

@section('scripts')
<script src="{{asset('assets/js/pages/widgets.js')}}"></script>
<script>
    function performDestroy(id,reference) {
        confirmDestroy('/cms/admin/complaints', id, reference);
    }
</script>
@endsection