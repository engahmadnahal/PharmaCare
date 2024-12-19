@extends('cms.parentv2')

@section('page-name',__('cms.regions'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.regions'))
@section('page-name-small',__('cms.index'))

@section('styles')

@endsection

@section('content')
<div class="card card-flush">
    <!--begin::Card header-->
    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
            <!--begin::Add product-->
            <a href="{{route('regions.create')}}" class="btn btn-primary">{{__('cms.create')}}</a>
            <!--end::Add product-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_tables">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th class="text-start min-w-70px">{{__('cms.name_ar')}}</th>
                    <th class="text-start min-w-70px">{{__('cms.name_en')}}</th>
                    <th class="text-start min-w-70px">{{__('cms.active')}}</th>
                    @canany(['Update-Region','Delete-Region'])
                    <th class="text-end min-w-70px">{{__('cms.actions')}}</th>
                    @endcanany

                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="fw-semibold text-gray-600">
                @foreach ($data as $c)

                <!--begin::Table row-->
                <tr>
                    <td class="text-start pe-0">
                        <span class="fw-bold">{{$c->name_ar}}</span>
                    </td>
                    <!--end::SKU=-->
                    <!--begin::Qty=-->
                    <td class="text-start pe-0" data-order="17">
                        <span class="fw-bold ms-3">{{$c->name_en}}</span>
                    </td>

                    <!--begin::Qty=-->
                    <td class="text-start pe-0" data-order="17">
                        <span class="fw-bold ms-3">{{$c->active_key}}</span>
                    </td>
                  
                    <!--end::Status=-->
                    <!--begin::Action=-->
                    <td class="text-end">
                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                        <span class="svg-icon svg-icon-5 m-0">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon--></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="../../demo39/dist/apps/ecommerce/catalog/edit-product.html" class="menu-link px-3">Edit</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-ecommerce-product-filter="delete_row">Delete</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                    <!--end::Action=-->
                </tr>
                @endforeach
            </tbody>
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>
@endsection

@section('scripts')
<script>
    function performDestroy(id,reference) {
        confirmDestroy('/cms/admin/regions', id, reference);
    }

</script>
@endsection