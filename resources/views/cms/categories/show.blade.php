@extends('cms.parent')

@section('page-name', __('cms.categories'))
@section('main-page', __('cms.content_management'))
@section('sub-page', __('cms.categories'))
@section('page-name-small', __('cms.show'))

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
                        <img alt="Pic" src="{{Storage::url($cat->image)}}">
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
                            <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{$cat->name}}
                            <!--end::Name-->
                            <!--begin::Contacts-->
                            <div class="d-flex flex-wrap my-2">
                                <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                    <!--end::Svg Icon-->
                                </span>Code ID -  {{$cat->code ?? '-'}}</a>
                                
                            </div>
                            <!--end::Contacts-->
                        </div>
                        <!--begin::User-->
                        <!--begin::Actions-->
                        
                        <!--end::Actions-->
                    </div>
                    <!--end::Title-->
                   
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
                        <i class="flaticon-pie-chart icon-2x text-muted font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">{{__('cms.sub_categories')}}</span>
                        <span class="font-weight-bolder font-size-h5">
                        <span class="text-dark-50 font-weight-bold"></span>{{$cat->subCategories->count()}}</span>
                    </div>
                </div>
                <!--end: Item-->
              
                
            </div>
            <!--end::Bottom-->
        </div>
    </div>
    

    <!--end::Card header-->

    <div class="card card-custom gutter-b " >
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">{{ __('cms.sub_categories') }}</span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm"> {{ $cat->subCategories->count() }}+
                    {{ __('cms.sub_categories') }}</span>
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
                            <th style="min-width: 150px">{{__('cms.code')}}</th>
                            <th style="min-width: 150px">{{__('cms.sub_sub_categories')}}</th>
                            <th style="min-width: 150px">{{__('cms.active')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cat->subCategories as $sub)
                                
                            <tr>

                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$sub->name}}</span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$sub->code ?? '-'}}</span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg"> {{$sub->subSubCategories->count() ?? '-'}}</span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$sub->active_key}}</span>
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
