@extends('cms.parent')

@section('page-name', __('cms.store'))
@section('main-page', __('cms.content_management'))
@section('sub-page', __('cms.store'))
@section('page-name-small', __('cms.profile'))

@section('styles')

@endsection

@section('content')
    <!--begin::Advance Table Widget 5-->
    <!--begin::Card header-->
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <!--begin::Top-->
            <div class="d-flex">
                <!--begin::Pic-->
                <div class="flex-shrink-0 mr-7">
                    <div class="symbol symbol-50 symbol-lg-120">
                        <img alt="Pic" src="{{Storage::url(auth('store')->user()->logo)}}">
                    </div>
                </div>

                <!--end::Pic-->
                <!--begin: Info-->
                
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                        <!--begin::User-->
                        <div class="mr-3">
                            <!--begin::Name-->
                            <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{auth('store')->user()->name}}
                            <i class="flaticon2-correct text-success icon-md ml-2"></i></a>
                            <!--end::Name-->
                            <!--begin::Contacts-->
                            <div class="d-flex flex-wrap my-2">
                                <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000"></path>
                                            <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"></circle>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>{{auth('store')->user()->email}}</a>
                                <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Lock.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <mask fill="white">
                                                <use xlink:href="#path-1"></use>
                                            </mask>
                                            <g></g>
                                            <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>{{__('cms.'.auth('store')->user()->type)}}</a>
                                <a href="#" class="text-muted text-hover-primary font-weight-bold">
                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Map/Marker2.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000"></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>{{auth('store')->user()->region->name}}</a>
                            </div>
                            <!--end::Contacts-->
                        </div>
                        <!--begin::User-->
                        <!--begin::Actions-->
                        <div class="my-lg-0 my-1">
						    <a href="{{route('cms.profile.personal-information')}}" class="btn btn-sm btn-primary font-weight-bolder text-uppercase">{{__('cms.edit_profile')}}</a>
						</div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Title-->
                    <!--begin::Content-->
                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                        <!--begin::Description-->
                        <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">{{auth('store')->user()->note}}.</div>
                        <!--end::Description-->
                        <!--begin::Progress-->
                        <div class="d-flex mt-4 mt-sm-0">
                            <span class="font-weight-bold mr-4">{{__('cms.rate')}}</span>
                            <div class="progress progress-xs mt-2 mb-2 flex-shrink-0 w-150px w-xl-250px">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{auth('store')->user()->rate_percentage}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="font-weight-bolder text-dark ml-4">{{auth('store')->user()->rate_percentage}}%</span>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Top-->
            <!--begin::Separator-->
            <div class="separator separator-solid my-7"></div>
            <!--end::Separator-->
            <!--begin::Bottom-->
            <div class="d-flex align-items-center flex-wrap">
               
                <!--begin: Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                    <span class="mr-4">
                        <i class="flaticon-confetti icon-2x text-muted font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">{{__('cms.user_rating')}}</span>
                        <span class="font-weight-bolder font-size-h5">
                        <span class="text-dark-50 font-weight-bold"></span>{{auth('store')->user()->rates->count()}}</span>
                    </div>
                </div>
                <!--end: Item-->
                <!--begin: Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                    <span class="mr-4">
                        <i class="flaticon-pie-chart icon-2x text-muted font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">{{__('cms.products')}}</span>
                        <span class="font-weight-bolder font-size-h5">
                        <span class="text-dark-50 font-weight-bold"></span>{{auth('store')->user()->products->count()}}</span>
                    </div>
                </div>
                <!--end: Item-->
                <!--begin: Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                    <span class="mr-4">
                        <i class="flaticon-price-tag icon-2x text-muted font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column flex-lg-fill">
                        <span class="text-dark-75 font-weight-bolder font-size-sm">{{auth('store')->user()->promoCode->count()}} {{__('cms.PromoCode')}}</span>
                        <a href="#promoCodes" class="text-primary font-weight-bolder">View</a>
                    </div>
                </div>
                <!--end: Item-->
                <!--begin: Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                    <span class="mr-4">
                        <i class="flaticon-pie-chart icon-2x text-muted font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column">
                        <span class="text-dark-75 font-weight-bolder font-size-sm">{{auth('store')->user()->dayWorks->count()}} {{__('cms.work_days')}}</span>
                        <a href="#dayWork" class="text-primary font-weight-bolder">View</a>
                    </div>
                </div>
                <!--end: Item-->
                <!--begin: Item-->
                <div class="d-flex align-items-center flex-lg-fill my-1">
                    <span class="mr-4">
                        <i class="flaticon-network icon-2x text-muted font-weight-bold"></i>
                    </span>
                    <div class="symbol-group symbol-hover">
                        @foreach (auth('store')->user()->rates->take(5) as $user)
                        
                        <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="" data-original-title="{{$user->first_name}} {{$user->last_name}}">
                            <img alt="Pic" src="{{asset('assets/media/users/300_21.jpg')}}">
                        </div>
                        @endforeach
                        
                    </div>
                </div>
                <!--end: Item-->
            </div>
            <!--end::Bottom-->
        </div>
    </div>
    <!--end::Card header-->

    <div class="card card-custom gutter-b " id="dayWork">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">{{ __('cms.work_days') }}</span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm"> {{ auth('store')->user()->dayWorks->count() }}
                    {{ __('cms.work_days') }}</span>
            </h3>

        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0 pb-3">
            <div class="tab-content">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                        <thead>
                            <tr class="text-left text-uppercase">
                                <th style="min-width: 250px" class="pl-7">
                                    <span class="text-dark-75">{{ __('cms.day') }}</span>
                                </th>
                                <th style="min-width: 100px">{{ __('cms.start_time') }}</th>
                                <th style="min-width: 100px"> {{ __('cms.end_time') }}</th>
                                <th style="min-width: 100px">{{ __('cms.note') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (auth('store')->user()->dayWorks as $d)
                                
                            <tr>

                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$d->day->translations->first()->name}}</span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$d->start_time->format('h:i a')}}</span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg"> {{$d->close_time->format('h:i a')}}</span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$d->translations->first()->note ?? '-'}}</span>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!--end::Table-->
            </div>
        </div>
        <!--end::Body-->
    </div>

    


    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">{{ __('cms.products') }}</span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm"> {{ auth('store')->user()->products->count() }}+ {{ __('cms.products') }}</span>
            </h3>

        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0 pb-3">
            <div class="tab-content">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                        <thead>
                            <tr class="text-left text-uppercase">
                                <th style="min-width: 250px" class="pl-7">
                                    <span class="text-dark-75">{{ __('cms.name') }}</span>
                                </th>
                                <th style="min-width: 100px">{{ __('cms.item_count') }}</th>
                                <th style="min-width: 100px"> {{ __('cms.category') }}</th>
                                <th style="min-width: 100px">{{ __('cms.price') }}</th>
                                <th style="min-width: 100px">{{ __('cms.view') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (auth('store')->user()->products as $pro)
                                
                            <tr>
                                <td class="pl-0 py-8">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50 symbol-light mr-4">
                                            <span class="symbol-label">
                                                <img src="{{Storage::url($pro->image)}}" class="h-75 align-self-end" alt="">
                                            </span>
                                        </div>
                                        <div>
                                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$pro->name}}</a>
                                            <span class="text-muted font-weight-bold d-block">{{$pro->trade->name}}</span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$pro->item_count ?? '0'}}</span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$pro->subSubCategory->name}}</span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg"> {{$pro->pivot->price}}</span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$pro->pivot->view}}</span>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!--end::Table-->
            </div>
        </div>
        <!--end::Body-->
    </div>

    <div class="card card-custom gutter-b ">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">{{ __('cms.PromoCode') }}</span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm"> {{ auth('store')->user()->promoCode->count() }}
                    {{ __('cms.PromoCode') }}</span>
            </h3>

        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-0 pb-3" id="promoCodes">
            <div class="tab-content">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                        <thead>
                            <tr class="text-left text-uppercase">
                                <th class="pl-0" style="min-width: 100px">{{__('cms.code')}}</th>
                                <th class="pl-0" style="min-width: 100px">{{__('cms.ratio')}}</th>
                                <th class="pl-0" style="min-width: 100px">{{__('cms.all_beneficiaries')}}</th>
                                <th class="pl-0" style="min-width: 100px">{{__('cms.current_beneficiaries')}}</th>
                                <th class="pl-0" style="min-width: 100px">{{__('cms.end_date')}}</th>
                                <th class="pl-0" style="min-width: 100px">{{__('cms.active')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (auth('store')->user()->promoCode as $proCode)
                                
                            <tr>

                                <td class="pl-0">
                                    <a href="#"
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$proCode->code}}</a>
                                </td>
                                <td class="pl-0">
                                    <a href="#"
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$proCode->ratio_key}}</a>
                                </td>
                                <td class="pl-0">
                                    <a href="#"
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$proCode->all_beneficiaries}}</a>
                                </td>
        
        
                                <td class="pl-0">
                                    <a href="#"
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$proCode->current_beneficiaries}}</a>
                                </td>
        
                                <td class="pl-0">
                                    <a href="#"
                                        class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg">{{$proCode->end_date}}</a>
                                </td>
        
                                <td>
                                    <span
                                        class="label label-lg @if($proCode->status) label-light-success @else label-light-warning @endif label-inline">{{$proCode->active_key}}</span>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!--end::Table-->
            </div>
        </div>
        <!--end::Body-->
    </div>

    <!--end::Advance Table Widget 5-->
@endsection

@section('scripts')

@endsection
