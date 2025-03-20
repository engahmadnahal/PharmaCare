@extends('cms.parent')

@section('page-name', __('cms.products'))
@section('main-page', __('cms.content_management'))
@section('sub-page', __('cms.products'))
@section('page-name-small', __('cms.show'))

@section('styles')

@endsection

@section('content')
    <!--begin::Advance Table Widget 5-->
    <!--begin::Card header-->
    <!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <!--begin::Details-->
            <div class="d-flex mb-9">
                <!--begin: Pic-->
                <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                    <div class="symbol symbol-50 symbol-lg-120">
                        <img src="{{ Storage::url($data->image) }}" alt="product image">
                    </div>
                </div>
                <!--end::Pic-->
                <!--begin::Info-->
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between flex-wrap mt-1">
                        <div class="d-flex mr-3">
                            <h3 class="text-dark-75 font-weight-bold mr-3">
                                {{ App::getLocale() == 'ar' ? $data->trade_name_ar : $data->trade_name_en }}
                            </h3>
                        </div>
                        <div class="my-lg-0 my-3">
                            {{ __('cms.craeted_at') }}
                            <a href="#"
                                class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3">{{ Carbon::parse($data->created_at)->format('Y-m-d') }}</a>
                            {{-- <a href="#" class="btn btn-sm btn-info font-weight-bolder text-uppercase">hire</a> --}}
                        </div>
                    </div>
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->
            <div class="separator separator-solid mb-5"></div>
            <!--begin::Product Details-->
            <div class="row">
                <!--begin::Basic Info-->
                <div class="col-xl-6">
                    <div class="card card-custom gutter-b">
                        <div class="card-header h-auto py-4">
                            <div class="card-title">
                                <h3 class="card-label">{{ __('cms.basic_information') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.category') }}</label>
                                    <p>{{ $data->category->name }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.medicine_type') }}</label>
                                    <p>{{ $data->medicineType->name }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.barcode') }}</label>
                                    <p>{{ $data->barcode }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.concentration') }}</label>
                                    <p>{{ $data->concentration_value }} {{ $data->concentration_unit }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.weight') }}</label>
                                    <p>{{ $data->weight }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.num_units_in_package') }}</label>
                                    <p>{{ $data->num_units_in_package }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--begin::Names Section-->
                <div class="col-xl-6">
                    <div class="card card-custom gutter-b">
                        <div class="card-header h-auto py-4">
                            <div class="card-title">
                                <h3 class="card-label">{{ __('cms.names') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.trade_name_ar') }}</label>
                                    <p>{{ $data->trade_name_ar }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.trade_name_en') }}</label>
                                    <p>{{ $data->trade_name_en }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.scientific_name_ar') }}</label>
                                    <p>{{ $data->scientific_name_ar }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.scientific_name_en') }}</label>
                                    <p>{{ $data->scientific_name_en }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!--begin::Descriptions Section-->
                <div class="col-xl-12">
                    <div class="card card-custom gutter-b">
                        <div class="card-header h-auto py-4">
                            <div class="card-title">
                                <h3 class="card-label">{{ __('cms.descriptions') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.drug_description_ar') }}</label>
                                    <p>{{ $data->drug_description_ar }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.drug_description_en') }}</label>
                                    <p>{{ $data->drug_description_en }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.indications_for_use_ar') }}</label>
                                    <p>{{ $data->indications_for_use_ar }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.indications_for_use_en') }}</label>
                                    <p>{{ $data->indications_for_use_en }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!--begin::Usage Information-->
                <div class="col-xl-12">
                    <div class="card card-custom gutter-b">
                        <div class="card-header h-auto py-4">
                            <div class="card-title">
                                <h3 class="card-label">{{ __('cms.usage_information') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.recommended_dosage_ar') }}</label>
                                    <p>{{ $data->recommended_dosage_ar }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.recommended_dosage_en') }}</label>
                                    <p>{{ $data->recommended_dosage_en }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.how_to_use_ar') }}</label>
                                    <p>{{ $data->how_to_use_ar }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.how_to_use_en') }}</label>
                                    <p>{{ $data->how_to_use_en }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!--begin::Medical Information-->
                <div class="col-xl-12">
                    <div class="card card-custom gutter-b">
                        <div class="card-header h-auto py-4">
                            <div class="card-title">
                                <h3 class="card-label">{{ __('cms.medical_information') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.drug_interactions_ar') }}</label>
                                    <p>{{ $data->drug_interactions_ar }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.drug_interactions_en') }}</label>
                                    <p>{{ $data->drug_interactions_en }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.side_effects_ar') }}</label>
                                    <p>{{ $data->side_effects_ar }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.side_effects_en') }}</label>
                                    <p>{{ $data->side_effects_en }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.alternative_medicines_ar') }}</label>
                                    <p>{{ $data->alternative_medicines_ar }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.alternative_medicines_en') }}</label>
                                    <p>{{ $data->alternative_medicines_en }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.complementary_medicines_ar') }}</label>
                                    <p>{{ $data->complementary_medicines_ar }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.complementary_medicines_en') }}</label>
                                    <p>{{ $data->complementary_medicines_en }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <!--begin::Pricing & Dates-->
                    <div class="card card-custom gutter-b">
                        <div class="card-header h-auto py-4">
                            <div class="card-title">
                                <h3 class="card-label">{{ __('cms.pricing_and_dates') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.basic_price') }}</label>
                                    <p>{{ $data->basic_price }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.retail_price') }}</label>
                                    <p>{{ $data->retail_price }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.expiration_date') }}</label>
                                    <p>{{ $data->expiration_date }}</p>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <label class="font-weight-bold">{{ __('cms.quantity') }}</label>
                                    <p>{{ $data->quantity }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Pricing & Dates-->
                </div>
            </div>

            <!--begin::Product Images-->
            <div class="row mt-5">
                <div class="col-xl-12">
                    <div class="card card-custom gutter-b">
                        <div class="card-header h-auto py-4">
                            <div class="card-title">
                                <h3 class="card-label">{{ __('cms.product_images') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <label class="font-weight-bold">{{ __('cms.product_image') }}</label>
                                    <div class="image-input image-input-outline mt-2">
                                        <img src="{{ Storage::url($data->image) }}" 
                                             class="img-fluid" 
                                             style="max-height: 250px;"
                                             alt="product image">
                                    </div>
                                </div>
                                <div class="col-md-6 text-center">
                                    <label class="font-weight-bold">{{ __('cms.leaflet_image') }}</label>
                                    <div class="image-input image-input-outline mt-2">
                                        <img src="{{ Storage::url($data->medication_leaflet_image) }}" 
                                             class="img-fluid" 
                                             style="max-height: 250px;"
                                             alt="leaflet image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ route('cms.employee.products.index') }}" class="btn btn-secondary">{{ __('cms.back') }}</a>
                    @can('Update-Product')
                        <a href="{{ route('cms.employee.products.edit', $data->id) }}" class="btn btn-primary">{{ __('cms.edit') }}</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <!--end::Card-->
    <!--begin::Row-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Advance Table Widget 2-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                {{-- <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">New Arrivals</span>
                        <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span>
                    </h3>
                    
                </div> --}}
              
            </div>
            <!--end::Advance Table Widget 2-->
        </div>
    </div>
    <!--end::Advance Table Widget 5-->
@endsection

@section('scripts')

@endsection
