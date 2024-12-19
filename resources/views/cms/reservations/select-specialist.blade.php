@extends('cms.parent')

@section('page-name',__('cms.specialists'))
@section('main-page',__('cms.hr'))
@section('sub-page',__('cms.specialists'))
@section('page-name-small',__('cms.index'))

@section('styles')

@endsection

@section('content')
<!--begin::Card-->
<div class="card card-custom gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 py-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">New Arrivals</span>
            <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span>
        </h3>
        <div class="card-toolbar">
            <a href="#" onclick="resetReservation()" class="btn btn-info font-weight-bolder font-size-sm">Reset
                Reservation</a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-0">
        <!--begin::Table-->
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
                <thead>
                    <tr class="text-left">
                        <th class="pl-0" style="width: 30px">
                            {{-- <label class="radio checkbox-lg checkbox-inline mr-2">
                                <input type="radio" value="1">
                                <span></span>
                            </label> --}}
                        </th>
                        <th class="pl-0" style="min-width: 120px">{{__('cms.info')}}</th>
                        <th style="min-width: 110px">{{__('cms.address')}}</th>

                        <th style="min-width: 120px">{{__('cms.qualification')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($specialists as $specialist)
                    <tr>
                        <td class="pl-0 py-6">
                            <label class="radio radio-lg radio-rounded">
                                <input type="radio" onclick="assignReservation('{{$specialist->id}}')" name="assigned"
                                    @if($specialist->assigned) checked
                                @endif>
                                <span></span>
                            </label>
                        </td>
                        <td class="pl-0">
                            <span
                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$specialist->name}}</span>
                            <span class="text-muted font-weight-bold">{{$specialist->gender_word}}</span>
                        </td>
                        {{-- <td class="pl-0">
                            <a href="#"
                                class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">56037-XDER</a>
                        </td> --}}
                        <td>
                            <span
                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$specialist->address}}</span>
                            <span class="text-muted font-weight-bold">{{$specialist->email}}</span>
                        </td>
                        <td>
                            <span
                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$specialist->qualification}}</span>
                            <span class="text-muted font-weight-bold">{{$specialist->experience_years}} Years</span>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!--end::Table-->
    </div>
    <!--end::Body-->
</div>
<!--end::Card-->
<!--begin::Pagination-->
{{-- <div class="card card-custom">
    <div class="card-body py-7">
        <!--begin::Pagination-->
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex flex-wrap mr-3">
                <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                    <i class="ki ki-bold-double-arrow-back icon-xs"></i>
                </a>
                <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                    <i class="ki ki-bold-arrow-back icon-xs"></i>
                </a>
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">23</a>
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">24</a>
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">25</a>
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">26</a>
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">27</a>
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">28</a>
                <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
                <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                    <i class="ki ki-bold-arrow-next icon-xs"></i>
                </a>
                <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
                    <i class="ki ki-bold-double-arrow-next icon-xs"></i>
                </a>
            </div>
            <div class="d-flex align-items-center">
                <select
                    class="form-control form-control-sm text-primary font-weight-bold mr-4 border-0 bg-light-primary"
                    style="width: 75px;">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span class="text-muted">Displaying 10 of 230 records</span>
            </div>
        </div>
        <!--end:: Pagination-->
    </div>
</div> --}}
<!--end::Pagination-->

@endsection

@section('scripts')
<script>
    function assignReservation(specialist_id) {
        let data = {
            specialist_id: specialist_id,
        }
        update('/cms/admin/reservations/{{$reservation->id}}/specialists',data);
    }
    function resetReservation() {
        let data = {}
        update('/cms/admin/reservations/{{$reservation->id}}/specialists/reset',data);
    }
</script>
@endsection