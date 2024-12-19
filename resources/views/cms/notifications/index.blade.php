@extends('cms.parent')

@section('page-name',__('cms.notifications'))
@section('main-page',__('cms.settings'))
@section('sub-page',__('cms.notifications'))
@section('page-name-small',__('cms.index'))

@section('styles')

@endsection

@section('content')
<!--begin::Advance Table Widget 5-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{__('cms.notifications')}}</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
        </h3>
        {{-- @can('Create-Order') --}}
        <div class="card-toolbar">
                <a href="{{route('notification_fcm_users.create')}}"
                class="btn btn-info font-weight-bolder font-size-sm mr-2">{{__('cms.create')}}</a>
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
                        <th style="min-width: 150px">{{__('cms.title')}}</th>
                        <th style="min-width: 150px">{{__('cms.message')}}</th>
                        <th style="min-width: 150px">{{__('cms.craeted_at')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $notf)
                    <tr>
                        <td class="pl-0">
                            {{++$loop->index}}
                        </td>

                        <td>
                            <span class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$notf->title
                                ?? ''}}</span>
                        </td>

                        <td>
                            <span class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$notf->body
                                ?? ''}}</span>
                        </td>

                        <td>
                            <span
                                class="label label-lg label-light-info label-inline">{{$notf->created_at->format('Y-m-d')}}</span>
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