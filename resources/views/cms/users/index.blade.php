@extends('cms.parent')

@section('page-name',__('cms.users'))
@section('main-page',__('cms.hr'))
@section('sub-page',__('cms.users'))
@section('page-name-small',__('cms.index'))

@section('styles')

@endsection

@section('content')
<!--begin::Advance Table Widget 5-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{__('cms.users')}}</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
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
                        <th style="min-width: 120px">{{__('cms.name')}}</th>
                        <th style="min-width: 120px">{{__('cms.mobile')}}</th>
                        <th style="min-width: 120px">{{__('cms.email')}}</th>
                        <th style="min-width: 120px">{{__('cms.country')}}</th>
                        <th style="min-width: 120px">{{__('cms.currency')}}</th>
                        <th style="min-width: 150px">{{__('cms.status')}}</th>
                        <th style="min-width: 130px">{{__('cms.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $user)
                    <tr>
                        <td class="pl-0">
                            <a href="{{route('users.show',$user->id)}}"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$user->name
                                ?? ''}}</a>
                        </td>

                        <td class="pl-0">
                            <a 
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$user->mobile
                                ?? ''}}</a>
                        </td>

                        <td class="pl-0">
                            <a
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$user->email
                                ?? ''}}</a>
                        </td>

                        <td class="pl-0">
                            <a 
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$user?->country?->name
                                ?? '--'}}</a>
                        </td>

                        <td class="pl-0">
                            <a 
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$user?->currencyTh->code
                                ?? '--'}}</a>
                        </td>

                        <td class="pl-0">
                            <a 
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$user->statusKey
                                ?? ''}}</a>
                        </td>

                        <td class="pr-0 text-right">

                            <a href="#" onclick="performBlock({{$user->id}})"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                   <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Lock-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                            <path d="M14.5,11 C15.0522847,11 15.5,11.4477153 15.5,12 L15.5,15 C15.5,15.5522847 15.0522847,16 14.5,16 L9.5,16 C8.94771525,16 8.5,15.5522847 8.5,15 L8.5,12 C8.5,11.4477153 8.94771525,11 9.5,11 L9.5,10.5 C9.5,9.11928813 10.6192881,8 12,8 C13.3807119,8 14.5,9.11928813 14.5,10.5 L14.5,11 Z M12,9 C11.1715729,9 10.5,9.67157288 10.5,10.5 L10.5,11 L13.5,11 L13.5,10.5 C13.5,9.67157288 12.8284271,9 12,9 Z" fill="#000000"/>
                                        </g>
                                    </svg>
                                </span>
                            </a>


                            <a href="{{route('users.show',$user->id)}}" 
                                class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                   <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Angle-double-left.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "/>
                                            <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) "/>
                                        </g>
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
    function performBlock(id) {
        let data = {
            user_id : id
        }
        store('/cms/admin/users/block',data);
    }
</script>
@endsection