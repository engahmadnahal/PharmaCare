@extends('cms.parent')

@section('page-name',__('cms.products'))
@section('main-page',__('cms.shop_content_management'))
@section('sub-page',__('cms.products'))
@section('page-name-small',__('cms.index'))

@section('styles')

@endsection

@section('content')
<div class="d-flex flex-row">
    <!--begin::Layout-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-body">
                <!--begin::Engage Widget 15-->
                <div class="card card-custom mb-12">
                    <div class="card-body rounded p-0 d-flex" style="background-color:#DAF0FD;">
                        <div class="d-flex flex-column flex-lg-row-auto w-auto w-lg-350px w-xl-450px w-xxl-500px p-10 p-md-20">
                            <h1 class="font-weight-bolder text-dark">PhotoMe Product</h1>
                            <div class="font-size-h4 mb-8">Get Amazing Products</div>
                           
                        </div>
                        <div class="d-none d-md-flex flex-row-fluid bgi-no-repeat bgi-position-y-center bgi-position-x-left bgi-size-cover" style="background-image: url({{asset('assets/media/svg/illustrations/progress.svg')}});"></div>
                    </div>
                </div>
                <!--end::Engage Widget 15-->
                <!--begin::Section-->
                <div class="mb-11">
               
                    <!--end::Heading-->
                    <!--begin::Products-->
                    <div class="row">
                        @foreach ($data as $product)
                            <div class="col-md-4 col-xxl-4 col-lg-12">
                                <!--begin::Card-->
                                <div class="card card-custom card-shadowless">
                                    <div class="card-body p-0">
                                        <!--begin::Image-->
                                        <div class="overlay">
                                            <div class="overlay-wrapper rounded bg-light text-center">
                                                <img src="{{Storage::url($product->image)}}" alt="" class="mw-100" style=" width: 100%; height: 200px; object-fit: cover; border-radius: 11px;">
                                            </div>
                                            <div class="overlay-layer">
                                                <a href="#" class="btn font-weight-bolder btn-sm btn-primary mr-2">{{$product->joomlaString}}</a>
                                            </div>
                                        </div>
                                        <!--end::Image-->
                                        <!--begin::Details-->
                                        <div class="text-center mt-5 mb-md-0 mb-lg-5 mb-md-0 mb-lg-5 mb-lg-0 mb-5 d-flex flex-column">
                                            <a href="#" class="font-size-h5 font-weight-bolder text-dark-75 text-hover-primary mb-1">{{$product->name}} - ({{$product->joomlaString}}) </a>
                                            <span class="font-size-lg">{{$product->description}}</span>
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                </div>
                                <!--end::Card-->
                            </div>
                        @endforeach
                        
                    </div>
                    <!--end::Products-->
                </div>
          
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Layout-->
</div>
@endsection

@section('scripts')
<script src="{{asset('assets/js/pages/widgets.js')}}"></script>
<script>
    function performcityDestroy(id,reference) {
        confirmDestroy('/cms/admin/products', id, reference);
    }
    function performTranslationDestroy(id,reference) {
        confirmDestroy('/cms/admin/products/translations', id, reference);
    }
</script>
@endsection