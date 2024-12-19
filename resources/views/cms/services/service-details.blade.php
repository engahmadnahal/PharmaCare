@extends('cms.parent')

@section('page-name','')
@section('main-page','')
@section('sub-page','')
@section('page-name-small','')

@section('styles')

@endsection

@section('content')
<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-body">
        <!--begin::Details-->
        <div class="d-flex mb-9">
            <!--begin: Pic-->
            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                <div class="symbol symbol-50 symbol-lg-120">
                    <img src="{{asset('assets/media/users/300_1.jpg')}}" alt="image" />
                </div>
                <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                    <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                </div>
            </div>
            <!--end::Pic-->
            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between flex-wrap mt-1">
                    <div class="d-flex mr-3">
                        <a href="#"
                            class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{$service->name_en}}</a>
                        <a href="#">
                            <i class="flaticon2-correct text-success font-size-h5"></i>
                        </a>
                    </div>
                    <div class="my-lg-0 my-3">
                        <a href="#" class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3">ask</a>
                        <a href="#" class="btn btn-sm btn-info font-weight-bolder text-uppercase">hire</a>
                    </div>
                </div>
                <!--end::Title-->
                <!--begin::Content-->
                <div class="d-flex flex-wrap justify-content-between mt-1">
                    <div class="d-flex flex-column flex-grow-1 pr-8">
                        <div class="d-flex flex-wrap mb-4">
                            <a href="#"
                                class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <i class="flaticon-squares-1 mr-2 font-size-lg"></i>{{$service->category->name_en}}</a>
                            <a href="#"
                                class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <i class="flaticon-price-tag mr-2 font-size-lg"></i>{{$service->payment_mechanism}}</a>
                            <a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                <i class="flaticon-coins mr-2 font-size-lg"></i>{{$service->price}}₪</a>
                        </div>
                        <span class="font-weight-bold text-dark-50">{{$service->info_en}}</span>
                        {{-- <span class="font-weight-bold text-dark-50">A second could be
                            persuade people.You want people to bay objective</span> --}}
                    </div>
                    {{-- <div class="d-flex align-items-center w-25 flex-fill float-right mt-lg-12 mt-8">
                        <span class="font-weight-bold text-dark-75">Progress</span>
                        <div class="progress progress-xs mx-3 w-100">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 63%;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="font-weight-bolder text-dark">78%</span>
                    </div> --}}
                </div>
                <!--end::Content-->
            </div>
            <!--end::Info-->
        </div>
        <!--end::Details-->
        <div class="separator separator-solid"></div>
        <!--begin::Items-->
        <div class="d-flex align-items-center flex-wrap mt-8">
            <!--begin::Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                <span class="mr-4">
                    <i class="flaticon-users display-4 text-muted font-weight-bold"></i>
                </span>
                <div class="d-flex flex-column flex-lg-fill">
                    <span class="text-dark-75 font-weight-bolder font-size-sm">{{count($service->specialists)}}
                        Specialist/s</span>
                    {{-- <a href="#" class="text-primary font-weight-bolder">View</a> --}}
                </div>
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                <span class="mr-4">
                    <i class="flaticon-pie-chart display-4 text-muted font-weight-bold"></i>
                </span>
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm">{{__('cms.reservations')}}</span>
                    <span class="font-weight-bolder font-size-h5">{{$service->reservations_count}}</span>
                </div>
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                <span class="mr-4">
                    <i class="flaticon-piggy-bank display-4 text-muted font-weight-bold"></i>
                </span>
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm">Earnings</span>
                    <span class="font-weight-bolder font-size-h5">
                        <span class="text-dark-50 font-weight-bold">$</span>249,500</span>
                </div>
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                <span class="mr-4">
                    <i class="flaticon-confetti display-4 text-muted font-weight-bold"></i>
                </span>
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm">Expenses</span>
                    <span class="font-weight-bolder font-size-h5">
                        <span class="text-dark-50 font-weight-bold">$</span>164,700</span>
                </div>
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                <span class="mr-4">
                    <i class="flaticon-file-2 display-4 text-muted font-weight-bold"></i>
                </span>
                <div class="d-flex flex-column">
                    <span class="text-dark-75 font-weight-bolder font-size-sm">{{$service->articles_count}}
                        {{__('cms.articles')}}</span>
                    {{-- <a href="#" class="text-primary font-weight-bolder">View</a> --}}
                </div>
            </div>
            <!--end::Item-->
        </div>
        <!--begin::Items-->
    </div>
</div>
<!--end::Card-->
<!--begin::Row-->
<div class="row">
    <div class="col-lg-8">
        <!--begin::Advance Table Widget 2-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">{{__('cms.reservations')}}</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span>
                </h3>
                <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_11_1">Waiting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_11_2">Assiged</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" data-toggle="tab" href="#kt_tab_pane_11_3">Rejected</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-2 pb-0 mt-n3">
                <div class="tab-content mt-5" id="myTabTables11">
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_tab_pane_11_1" role="tabpanel" aria-labelledby="kt_tab_pane_11_1">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table table-borderless table-vertical-center">
                                <thead>
                                    <tr>
                                        <th class="p-0 w-40px"></th>
                                        <th class="p-0 min-w-120px"></th>
                                        <th class="p-0 min-w-100px"></th>
                                        <th class="p-0 min-w-125px"></th>
                                        <th class="p-0 min-w-110px"></th>
                                        <th class="p-0 min-w-150px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service->reservations as $reservation)
                                    @if($reservation->status == 'Waiting')
                                    <tr>
                                        <td class="pl-0 py-4">
                                            <div class="symbol symbol-50 symbol-light">
                                                <span class="symbol-label">
                                                    <img src="assets/media/svg/misc/003-puzzle.svg"
                                                        class="h-50 align-self-center" alt="" />
                                                </span>
                                            </div>
                                        </td>
                                        <td class="pl-0">
                                            <a href="#"
                                                class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$reservation->user->name}}</a>
                                            <div>
                                                <span class="font-weight-bolder">Mobile:</span>
                                                <a class="text-muted font-weight-bold text-hover-primary"
                                                    href="#">{{$reservation->user->mobile}}</a>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <span
                                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$reservation->price}}₪</span>
                                            <span class="text-muted font-weight-bold">{{$reservation->payment}}</span>
                                        </td>
                                        <td class="text-right">
                                            <span
                                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$reservation->date}}</span>
                                            <span class="text-muted font-weight-bold">{{$reservation->time}}</span>
                                        </td>
                                        <td class="text-right">
                                            <span
                                                class="label label-lg @if($reservation->user->gender == 'M') label-light-success @else label-light-info @endif label-inline">{{$reservation->user->gender_name}}</span>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Tap pane-->
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_tab_pane_11_2" role="tabpanel" aria-labelledby="kt_tab_pane_11_2">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table table-borderless table-vertical-center">
                                <thead>
                                    <tr>
                                        <th class="p-0 w-40px"></th>
                                        <th class="p-0 min-w-120px"></th>
                                        <th class="p-0 min-w-120px"></th>
                                        <th class="p-0 min-w-100px"></th>
                                        <th class="p-0 min-w-125px"></th>
                                        <th class="p-0 min-w-110px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service->reservations as $reservation)
                                    @if($reservation->status == 'Assigned')
                                    <tr>
                                        <td class="pl-0 py-4">
                                            <div class="symbol symbol-50 symbol-light">
                                                <span class="symbol-label">
                                                    <img src="assets/media/svg/misc/003-puzzle.svg"
                                                        class="h-50 align-self-center" alt="" />
                                                </span>
                                            </div>
                                        </td>
                                        <td class="pl-0">
                                            <a href="#"
                                                class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$reservation->user->name}}</a>
                                            <div>
                                                <span class="font-weight-bolder">Mobile:</span>
                                                <a class="text-muted font-weight-bold text-hover-primary"
                                                    href="#">{{$reservation->user->mobile}}</a>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <span
                                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$reservation->specialist->full_name}}</span>
                                            <span
                                                class="text-muted font-weight-bold">{{$reservation->specialist->gender_word}}</span>
                                        </td>
                                        <td class="text-right">
                                            <span
                                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$reservation->price}}₪</span>
                                            <span class="text-muted font-weight-bold">{{$reservation->payment}}</span>
                                        </td>
                                        <td class="text-right">
                                            <span
                                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$reservation->date}}</span>
                                            <span class="text-muted font-weight-bold">{{$reservation->time}}</span>
                                        </td>
                                        <td class="text-right">
                                            <span
                                                class="label label-lg @if($reservation->user->gender == 'M') label-light-success @else label-light-info @endif label-inline">{{$reservation->user->gender_name}}</span>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Tap pane-->
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade show active" id="kt_tab_pane_11_3" role="tabpanel"
                        aria-labelledby="kt_tab_pane_11_3">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table table-borderless table-vertical-center">
                                <thead>
                                    <tr>
                                        <th class="p-0 w-40px"></th>
                                        <th class="p-0 min-w-120px"></th>
                                        <th class="p-0 min-w-100px"></th>
                                        <th class="p-0 min-w-125px"></th>
                                        <th class="p-0 min-w-110px"></th>
                                        {{-- <th class="p-0 min-w-150px"></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service->reservations as $reservation)
                                    @if($reservation->status == 'Rejected')
                                    <tr>
                                        <td class="pl-0 py-4">
                                            <div class="symbol symbol-50 symbol-light">
                                                <span class="symbol-label">
                                                    <img src="assets/media/svg/misc/003-puzzle.svg"
                                                        class="h-50 align-self-center" alt="" />
                                                </span>
                                            </div>
                                        </td>
                                        <td class="pl-0">
                                            <a href="#"
                                                class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$reservation->user->name}}</a>
                                            <div>
                                                <span class="font-weight-bolder">Mobile:</span>
                                                <a class="text-muted font-weight-bold text-hover-primary"
                                                    href="#">{{$reservation->user->mobile}}</a>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <span
                                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$reservation->price}}₪</span>
                                            <span class="text-muted font-weight-bold">{{$reservation->payment}}</span>
                                        </td>
                                        <td class="text-right">
                                            <span
                                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$reservation->date}}</span>
                                            <span class="text-muted font-weight-bold">{{$reservation->time}}</span>
                                        </td>
                                        <td class="text-right">
                                            <span
                                                class="label label-lg @if($reservation->user->gender == 'M') label-light-success @else label-light-info @endif label-inline">{{$reservation->user->gender_name}}</span>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Tap pane-->
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Advance Table Widget 2-->
    </div>
    <div class="col-lg-4">
        <!--begin::Mixed Widget 14-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bold font-size-h4 text-dark-75">Latest Articles</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Total
                        <span class="text-primary font-weight-bolder">{{$service->articles_count}}
                            {{__('cms.articles')}}</span></span>
                </h3>
                <div class="card-toolbar">
                    {{-- <ul class="nav nav-pills nav-pills-sm nav-dark">
                        <li class="nav-item ml-0">
                            <a class="nav-link py-2 px-4 font-weight-bolder font-size-sm" data-toggle="tab"
                                href="#kt_tab_pane_1_1">Year</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active font-weight-bolder font-size-sm" data-toggle="tab"
                                href="#kt_tab_pane_2_2">Month</a>
                        </li>
                    </ul> --}}
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-1">
                <div class="tab-content mt-5" id="myTabLIist18">
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade show active" id="kt_tab_pane_2_2" role="tabpanel"
                        aria-labelledby="kt_tab_pane_2_2">
                        <!--begin::Form-->
                        <div class="form">
                            @foreach ($service->articles as $article)
                            <!--begin::Item-->
                            <div class="d-flex align-items-center pb-9">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                                    <div class="symbol-label"
                                        style="background-image: url('{{Storage::url($article->image)}}')"></div>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex flex-column flex-grow-1">
                                    <!--begin::Title-->
                                    <a href="#"
                                        class="text-dark-75 font-weight-bolder font-size-lg text-hover-primary mb-1">{{$article->title_en}}</a>
                                    <!--end::Title-->
                                    <!--begin::Desc-->
                                    <span
                                        class="text-dark-50 font-weight-normal font-size-sm">{{$article->content_en}}</span>
                                    <!--begin::Desc-->
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            @endforeach
                        </div>
                        <!--end::Form-->
                    </div>
                    <!--end::Tap pane-->
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 14-->
    </div>
</div>
<!--end::Row-->
<!--begin::Row-->
<div class="row">
    <div class="col-lg-4">
        <!--begin::Charts Widget 4-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header h-auto border-0">
                <div class="card-title py-5">
                    <h3 class="card-label">
                        <span class="d-block text-dark font-weight-bolder">{{__('cms.specialists')}}</span>
                        <span class="d-block text-muted mt-2 font-size-sm">More than 500+ new orders</span>
                    </h3>
                </div>
                {{-- <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark-75" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_charts_widget_2_chart_tab_1">
                                <span class="nav-text font-size-sm">Month</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_charts_widget_2_chart_tab_2">
                                <span class="nav-text font-size-sm">Week</span>
                            </a>
                        </li>
                    </ul>
                </div> --}}
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                {{-- <div id="kt_charts_widget_4_chart"></div> --}}
                @foreach ($service->specialists as $specialist)
                <div class="d-flex align-items-center mb-10">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-40 symbol-light-success mr-5">
                        <span class="symbol-label">
                            <img src="assets/media/svg/avatars/009-boy-4.svg" class="h-75 align-self-end" alt="">
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                        <a href="#"
                            class="text-dark text-hover-primary mb-1 font-size-lg">{{$specialist->full_name}}</a>
                        <span class="text-muted">{{$specialist->mobile}}</span>
                    </div>
                    <!--end::Text-->
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="" data-placement="left"
                        data-original-title="Quick actions">
                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                        </a>
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right" style="">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header font-weight-bold py-4">
                                    <span class="font-size-lg">Choose Label:</span>
                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip"
                                        data-placement="right" title=""
                                        data-original-title="Click to learn more..."></i>
                                </li>
                                <li class="navi-separator mb-3 opacity-70"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-text">
                                            <span class="label label-xl label-inline label-light-dark">Staff</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="navi-separator mt-3 opacity-70"></li>
                                <li class="navi-footer py-4">
                                    <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                        <i class="ki ki-plus icon-sm"></i>Add new</a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                @endforeach
            </div>
            <!--end::Body-->
        </div>
        <!--end::Charts Widget 4-->
    </div>
    <div class="col-lg-8">
        <!--begin::List Widget 11-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">{{__('cms.faqs')}}</h3>
                <div class="card-toolbar">
                    <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions"
                        data-placement="left">
                        <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-ver"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover py-5">
                                <li class="navi-item">
                                    <a href="{{route('service-faqs.create',$service->id)}}" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-drop"></i>
                                        </span>
                                        <span class="navi-text">New Question</span>
                                    </a>
                                </li>
                                {{-- <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-rocket-1"></i>
                                        </span>
                                        <span class="navi-text">Groups</span>
                                        <span class="navi-link-badge">
                                            <span
                                                class="label label-light-primary label-inline font-weight-bold">new</span>
                                        </span>
                                    </a>
                                </li> --}}
                                <li class="navi-separator my-3"></li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="flaticon2-magnifier-tool"></i>
                                        </span>
                                        <span class="navi-text">Help</span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Header-->
            @foreach ($service->faqs as $faq)
            <div class="accordion accordion-solid accordion-panel accordion-svg-toggle" id="faq">
                <div class="card p-4">
                    <!--begin::Header-->
                    <div class="card-header" id="faqHeading1">
                        <div class="card-title font-size-h4 text-dark" data-toggle="collapse"
                            data-target="#faq_{{$faq->id}}" aria-expanded="false" aria-controls="faq_{{$faq->id}}"
                            role="button">
                            <div class="card-label">{{$faq->question_en}}</div>
                            <span class="svg-icon svg-icon-primary">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path
                                            d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                        <path
                                            d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                                            transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            <div class="card-toolbar ml-5">
                                <a href="{{route('faqs.edit',$faq->id)}}"
                                    class="btn btn-icon btn-sm btn-light-success mr-1">
                                    <i class="ki ki-wrench icon-nm"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-sm btn-light-danger" data-card-tool="remove">
                                    <i class="ki ki-close icon-nm"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div id="faq_{{$faq->id}}" class="collapse" aria-labelledby="faqHeading1"
                        data-parent="#faq_{{$faq->id}}">
                        <div class="card-body pt-3 font-size-h6 font-weight-normal text-dark-50">{{$faq->answer_en}}
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            {{--
            <!--begin::Body-->
            <div class="card-body pt-0">
                <!--begin::Card bg-light-warning -->
                <div class="card card-custom card-collapsed d-flex bg-light-warning rounded" data-card="true"
                    id="kt_card_4">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">{{$faq->question_en}}</h3>
                        </div>
                        <div class="card-toolbar">
                            <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-1" data-card-tool="toggle">
                                <i class="ki ki-arrow-down icon-nm"></i>
                            </a>
                            <a href="{{route('faqs.edit',$faq->id)}}"
                                class="btn btn-icon btn-sm btn-light-success mr-1">
                                <i class="ki ki-wrench icon-nm"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-sm btn-light-danger" data-card-tool="remove">
                                <i class="ki ki-close icon-nm"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{$faq->answer_en}}</p>
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body--> --}}
            @endforeach
        </div>
        <!--end::List Widget 11-->
    </div>
</div>
@endsection

@section('scripts')
<!--begin::Page Scripts(used by this page)-->
<script src="{{asset('assets/js/pages/features/cards/tools.js')}}"></script>
<!--end::Page Scripts-->
@endsection