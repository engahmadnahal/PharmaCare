@extends('cms.parent')

@section('page-name',__('cms.sub_sub_categories'))
@section('main-page',__('cms.shop_content_management'))
@section('sub-page',__('cms.sub_sub_categories'))
@section('page-name-small',__('cms.import_excel'))

@section('styles')

@endsection

@section('content')
<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">

        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">
                   
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.excel_file')}}:</label>
                        <div class="col-9">
                            <input type="file" class="form-control" id="excel_file" placeholder="{{__('cms.excel_file')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.excel_file')}}</span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>



                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="performStore()"
                                class="btn btn-primary mr-2">{{__('cms.save')}}</button>
                            <button type="reset" class="btn btn-secondary">{{__('cms.cancel')}}</button>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
</div>
<!--end::Container-->
@endsection

@section('scripts')
<script>
   function blockUI() {
            KTApp.blockPage({
                overlayColor: 'blue',
                opacity: 0.1,
                state: 'primary' // a bootstrap color
            });
        }

        function unBlockUI() {
            KTApp.unblockPage();
        }
    function performStore(){
            let formData = new FormData();
            formData.append('excel_file',document.getElementById('excel_file').files[0]);
            blockUI();
              store('/cms/admin/subSubCategories/import/excel',formData);
              unBlockUI();

            }
</script>
@endsection