@extends('cms.parent')

@section('page-name',__('cms.term'))
@section('main-page',__('cms.settings'))
@section('sub-page',__('cms.term'))
@section('page-name-small',__('cms.index'))

@section('styles')

@endsection

@section('content')
<!--begin::Advance Table Widget 5-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{__('cms.term')}}</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
        </h3>
        @can('Create-Term')
        <div class="card-toolbar">
            @if (count($data) == 0)
                
            <a href="{{route('term_users.create')}}"
            class="btn btn-info font-weight-bolder font-size-sm">{{__('cms.create')}}</a>
            @endif
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
                        <th class="pl-0" style="min-width: 100px">{{__('cms.title_ar')}}</th>
                        <th class="pl-0" style="min-width: 100px">{{__('cms.title_en')}}</th>
                        @canany(['Update-About','Delete-About'])
                        <th class="pr-0 text-right" style="min-width: 160px">{{__('cms.actions')}}</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $a)
                    <tr>
                        
                        <td class="pl-0">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$a->title_ar}}</a>
                        </td>
                        <td class="pl-0">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$a->title_en}}</a>
                        </td>
                        
                        <td class="pr-0 text-right">
                            @can('Update-Term')
                            <a href="{{route('term_users.edit',$a->id)}}"
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
        confirmDestroy('/cms/admin/term_users', id, reference);
    }
 
</script>
@endsection