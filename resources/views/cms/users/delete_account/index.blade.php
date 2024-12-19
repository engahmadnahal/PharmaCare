@extends('cms.parent')

@section('page-name', __('cms.users'))
@section('main-page', __('cms.hr'))
@section('sub-page', __('cms.users'))
@section('page-name-small', __('cms.index'))

@section('styles')

@endsection

@section('content')
    <!--begin::Advance Table Widget 5-->
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">{{ __('cms.users') }}</span>
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
                            <th style="min-width: 120px">{{ __('cms.name') }}</th>
                            <th style="min-width: 120px">{{ __('cms.mobile') }}</th>
                            <th style="min-width: 120px">{{ __('cms.email') }}</th>
                            <th style="min-width: 120px">{{ __('cms.country') }}</th>
                            <th style="min-width: 150px">{{ __('cms.status') }}</th>
                            <th style="min-width: 130px">{{ __('cms.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $req)
                            <tr>
                                <td class="pl-0">
                                    <a href="{{ route('users.show', $req->user->id) }}"
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $req->user->name ?? '' }}</a>
                                </td>

                                <td class="pl-0">
                                    <a
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $req->user->mobile ?? '' }}</a>
                                </td>

                                <td class="pl-0">
                                    <a
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $req->user->email ?? '' }}</a>
                                </td>

                                <td class="pl-0">
                                    <a
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $req->user?->country?->name ?? '--' }}</a>
                                </td>


                                <td class="pl-0">
                                    <a
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{ $req->status ?? '' }}</a>
                                </td>

                                <td class="pr-0 text-right">

                                    

                                        <a href="#" data-toggle="modal" data-target="#user_{{ $req->user->id }}_delete"
                                            class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Check.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path
                                                            d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z"
                                                            fill="#000000" fill-rule="nonzero"
                                                            transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002) " />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </a>


                                        <div class="modal fade" id="user_{{ $req->user->id }}_delete" tabindex="-1"
                                            role="dialog" aria-labelledby="user_{{ $req->user->id }}_delete"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <i aria-hidden="true" class="ki ki-close"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group row mt-4">
                                                            <label class="col-3 col-form-label">{{ __('cms.language') }}:<span
                                                                    class="text-danger">*</span></label>
                                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                                <div class="dropdown bootstrap-select form-control dropup">
                                                                    <select class="form-control selectpicker" data-size="7"
                                                                        id="status_{{ $req->id }}"
                                                                        title="Choose one of the following..." tabindex="null"
                                                                        data-live-search="true">
                                                                        <option value="wait" @selected($req->status == 'wait')>Wait</option>
                                                                        <option value="success" @selected($req->status == 'success')>Accept</option>
                                                                        <option value="reject" @selected($req->status == 'reject')>Reject</option>
                                                                    </select>
                                                                </div>
                                                                <span
                                                                    class="form-text text-muted">{{ __('cms.please_select') }}
                                                                    {{ __('cms.status') }}</span>
                                                            </div>
                                                        </div>

                                                        <x-textarea id="reason_{{ $req->id }}"
                                                            name="{{ __('cms.reasone') }}" value="{{$req->reason}}"/>


                                                    </div>
                                                    <div class="modal-footer">
                                                        @if ($req->status != 'success')
                                                        <button type="button" class="btn btn-light-primary font-weight-bold"
                                                        onclick="actionDelete({{ $req->id }})">Accept</button>
                                                        @endif

                                                        <button type="button" class="btn btn-light-primary font-weight-bold"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    <a href="{{ route('users.show', $req->user->id) }}"
                                        class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                                            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Angle-double-left.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24" />
                                                    <path
                                                        d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                                        fill="#000000" fill-rule="nonzero"
                                                        transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                                                    <path
                                                        d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="0.3"
                                                        transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
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
    <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
    <script>
        function actionDelete(id) {
            let data = {
                status: $('#status_' + id).val(),
                reason: $('#reason_' + id).val(),
            }
            update('/cms/admin/delete_account_users/' + id, data);
        }
    </script>
@endsection
