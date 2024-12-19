@extends('cms.parent')

@section('page-name',__('cms.countries'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.countries'))
@section('page-name-small',__('cms.index'))

@section('styles')

@endsection

@section('content')
<!--begin::Advance Table Widget 5-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{__('cms.countries')}}</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
        </h3>
        @can('Create-Country')
        <div class="card-toolbar">
            <a href="{{route('countries.create')}}"
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
                        <th class="pl-0" style="min-width: 100px">{{__('cms.name_ar')}}</th>
                        <th class="pl-0" style="min-width: 100px">{{__('cms.name_en')}}</th>
                        <th class="pl-0" style="min-width: 100px">{{__('cms.currency')}}</th>
                        <th class="pl-0" style="min-width: 100px">{{__('cms.tax')}}</th>
                        <th style="min-width: 150px">{{__('cms.cities')}}</th>
                        <th style="min-width: 150px">{{__('cms.active')}}</th>
                        @canany(['Update-Country','Delete-Country'])
                        <th class="pr-0 text-right" style="min-width: 160px">{{__('cms.actions')}}</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $country)
                    <tr>
                        
                        <td class="pl-0">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$country->name_ar}}</a>
                        </td>
                        <td class="pl-0">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$country->name_en}}</a>
                        </td>
                        <td class="pl-0">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$country->currency->name}}</a>
                        </td>
                        
                        <td>
                            <span class="label label-lg label-light-info label-inline">{{$country->tax}} {{$country->currency->code}}</span>
                        </td>

                        <td>
                            <span class="label label-lg label-light-info label-inline">{{$country->cities_count}}</span>
                        </td>
                        <td>
                            <span
                                class="label label-lg @if($country->active) label-light-success @else label-light-warning @endif label-inline">{{$country->active_key}}</span>
                        </td>
                        <td class="pr-0 text-right">
                            @can('Update-Country')
                            <a href="{{route('countries.edit',$country->id)}}"
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
                            @can('Delete-Country')
                            <a href="#" onclick="performCountryDestroy('{{$country->id}}', this)"
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
    function performCountryDestroy(id,reference) {
        confirmDestroy('/cms/admin/countries', id, reference);
    }
 
</script>
@endsection