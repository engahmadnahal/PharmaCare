@extends('cms.parent')

@section('page-name',__('cms.sub_branch'))
@section('main-page',__('cms.hr'))
@section('sub-page',__('cms.sub_branch'))
@section('page-name-small',__('cms.index'))

@section('styles')

@endsection

@section('content')
<!--begin::Advance Table Widget 5-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{__('cms.sub_branch')}}</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm"></span>
        </h3>
        <div class="card-toolbar">
            @can('Create-StudioBranch')
                
            <a href="{{route('studio_branches.create')}}"
            class="btn btn-info font-weight-bolder font-size-sm mr-2">{{__('cms.create')}}</a>
            @endcan
            

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
                        @can('Create-StudioBranch')
                        <th style="min-width: 120px">{{__('cms.services')}}</th>
                        @endcan
                        <th style="min-width: 150px">{{__('cms.mobile')}}</th>
                        <th style="min-width: 150px">{{__('cms.email')}}</th>
                        <th style="min-width: 150px">{{__('cms.currency')}}</th>
                        <th style="min-width: 130px">{{__('cms.account_status')}}</th>
                        <th style="min-width: 130px">{{__('cms.accepted_status')}}</th>
                        <th style="min-width: 130px">{{__('cms.blocked')}}</th>
                        <th style="min-width: 130px">{{__('cms.craeted_at')}}</th>
                        @canany(['Create-StudioBranch','Update-StudioBranch'])
                        <th class="pr-0 text-right" style="min-width: 160px">{{__('cms.actions')}}</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $std)
                    <tr>
                      

                        <td class="pl-0">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$std->name}}</a>
                        </td>

                        @can('Create-StudioBranch')
                            
                        <td>
                            <a href="{{route('studios.show_services',$std->id)}}"
                                class="btn btn-light-primary font-weight-bolder font-size-sm">({{$std->services->count()}})</a>
                        </td>
                        @endcan

                        <td>
                            <span
                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$std->mobile}}</span>
                        </td>
                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$std->email}}</span>
                        </td>

                        <td>
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$std->currencyCode}}</span>
                        </td>
                       
                        <td>
                            <span
                                class="label label-lg @if($std->active) label-light-success @else label-light-danger @endif label-inline">{{$std->active_key}}</span>
                        </td>

                        <td>
                            <span
                                class="label label-lg @if($std->isAcceptable == 'accept') label-light-success @elseif($std->isAcceptable == 'wait') label-light-warning @else label-light-danger @endif label-inline">{{$std->is_acceptable_key}}</span>
                        </td>

                        <td>
                            <span
                                class="label label-lg @if(!$std->block) label-light-success @else label-light-danger @endif label-inline">{{$std->block ? 'Yes' : 'No'}}</span>
                        </td>

                        <td>
                            <span
                            class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$std->created_at->format('Y-m-d')}}</span>
                        </td>
                        @canany(['Create-StudioBranch','Update-StudioBranch'])

                        <td class="pr-0 text-right">
                            @can('Block-StudioBranch')

                            <a href="#" data-toggle="modal" data-target="#block_{{$std->id}}_studio"
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

                          

                            <div class="modal fade" id="block_{{$std->id}}_studio" tabindex="-1" role="dialog"
                                aria-labelledby="block_{{$std->id}}_studio" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{__('cms.block')}}  - {{$std->name}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row mt-4">
                                                <label class="col-3 col-form-label">{{__('cms.reasone')}}:</label>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" id="reasone_{{$std->id}}"
                                                    placeholder="{{__('cms.reasone')}}" value="{{$std->reson_block}}"/>
                                                    <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.reasone')}}</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">{{__('cms.block')}}</label>
                                                <div class="col-3">
                                                    <span class="switch switch-outline switch-icon switch-success">
                                                        <label>
                                                            <input type="checkbox" @checked($std->block)
                                                            id="block_{{$std->id}}">
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary font-weight-bold" onclick="block({{$std->id}})">Save</button>

                                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endcan

                            @can('Update-StudioBranch')
                            <a href="{{route('studio_branches.edit',$std->id)}}"
                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                            <path
                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                            @endcan
                            @can('Delete-StudioBranch')
                            <a href="#" onclick="performDestroy('{{$std->id}}', this)"
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
                        @endcanany
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

    function block(stdId){
        
        let data = {
            branch_id : stdId,
            reson_block : document.getElementById('reasone_'+stdId).value,
            block : document.getElementById('block_'+stdId).checked,
        };
        store('/cms/admin/studios/block',data);
    }

    function performDestroy(id,reference) {
        confirmDestroy('/cms/admin/studio_branches', id, reference);
    }
</script>
@endsection