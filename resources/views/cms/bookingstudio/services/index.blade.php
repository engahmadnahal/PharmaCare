@extends('cms.parent')

@section('page-name',__('cms.serviceStudio'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.serviceStudio'))
@section('page-name-small',__('cms.index'))

@section('styles')

@endsection

@section('content')
<!--begin::Advance Table Widget 5-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{__('cms.serviceStudio')}}</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
        </h3>
        @can('Create-BookingStudioService')
        <div class="card-toolbar">
            <a href="{{route('services_booking_studios.create')}}"
                class="btn btn-info font-weight-bolder font-size-sm">{{__('cms.create')}}</a>
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
                        <th class="pl-0" style="min-width: 100px">{{__('cms.title')}}</th>
                        <th class="pl-0" style="min-width: 100px">{{__('cms.description')}}</th>
                        <th class="pl-0" style="min-width: 100px">{{__('cms.price')}}</th>
                        @canany(['Update-BookingStudioService','Delete-BookingStudioService'])
                        <th class="pr-0 text-right" style="min-width: 160px">{{__('cms.actions')}}</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $c)
                    <tr>
                        
                        <td class="pl-0">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$c->title}}</a>
                        </td>
                     
                        <td class="pl-0">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$c->description}}</a>
                        </td>
                      
                        
                        <td>
                            <a href="#" data-toggle="modal" data-target="#c_{{$c->id}}_translations"
                                class="btn btn-light-primary font-weight-bolder font-size-sm">({{$c->price->count()}})</a>
                            <div class="modal fade" id="c_{{$c->id}}_translations" tabindex="-1" role="dialog"
                                aria-labelledby="c_{{$c->id}}_translations" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{__('cms.currency')}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{__('cms.currency')}}</th>
                                                        <th scope="col">{{__('cms.price')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($c->price as $p)
                                                    <tr>
                                                        <td>
                                                            <span
                                                                class="text-info font-weight-bolder d-block font-size-lg">{{$p->currency->name}}</span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="text-info font-weight-bolder d-block font-size-lg">{{$p->price}} {{$p->currency->code}}</span>
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

                        
                        <td class="pr-0 text-right">
                            @can('Update-BookingStudioService')
                            <a href="{{route('services_booking_studios.edit',$c->id)}}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                            <path
                                                d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                                fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            @endcan
                            @can('Delete-BookingStudioService')
                            <a href="#" onclick="performDestroy('{{$c->id}}', this)"
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
<script src="{{asset('assets/js/pages/widgets.js')}}"></script>
<script>
    function performDestroy(id,reference) {
        confirmDestroy('/cms/admin/services_booking_studios', id, reference);
    }
</script>
@endsection