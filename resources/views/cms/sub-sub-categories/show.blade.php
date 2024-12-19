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
                        <img alt="Pic" src="{{Storage::url($subCat->image)}}">
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
                            <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{$subCat->name}}
                            <!--end::Name-->
                            <!--begin::Contacts-->
                            <div class="d-flex flex-wrap my-2">
                                <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                    <!--end::Svg Icon-->
                                </span>Code ID -  {{$subCat->code ?? '-'}}</a>
                                
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
                        <span class="font-weight-bolder font-size-sm">{{__('cms.categories')}}</span>
                        <span class="font-weight-bolder font-size-h5">
                        <span class="text-dark-50 font-weight-bold"></span>{{$subCat->subCategory->name}}</span>
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
                        <span class="text-dark-50 font-weight-bold"></span>{{$subCat->products->count()}}</span>
                    </div>
                </div>
                <!--end: Item-->
              
                
            </div>
            <!--end::Bottom-->
        </div>
    </div>
    

    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">{{ __('cms.products') }}</span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm"> {{ $subCat->products->count() }}+ {{ __('cms.products') }}</span>
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
                            @foreach ($subCat->products as $pro)
                                
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
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg"> {{$pro->price}}</span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$pro->view}}</span>
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

    <!--end::Card header-->
    

    <!--end::Advance Table Widget 5-->
@endsection

@section('scripts')

@endsection
