@extends('cms.parent')

@section('page-name',__('cms.products'))
@section('main-page',__('cms.shop_content_management'))
@section('sub-page',__('cms.products'))
@section('page-name-small',__('cms.index'))

@section('styles')

@endsection

@section('content')
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
                        <label class="col-3 col-form-label">{{__('cms.currency')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="currency_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($currency as $crr)
                                        <option value="{{$crr->id}}">{{$crr->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.currency')}}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.studio')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="studio_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($studios as $std)
                                        <option value="{{$std->id}}">{{$std->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.studio')}}</span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <x-input name="{{__('cms.item_count')}}" type="number" id="item_count"/>
                    <x-input type="number" name="{{ __('cms.price') }} " id="price" />

                  

                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.settings')}}</h3>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="send()"
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
@endsection

@section('scripts')
<script src="{{asset('assets/js/pages/widgets.js')}}"></script>
<script>
    function send(){
        let data = {
            item_count : $('#item_count').val(),
            currency_id : $('#currency_id').val(),
            studio_id : $('#studio_id').val(),
            price : $('#price').val(),
        };
        store('/cms/admin/products/{{$product->id}}/distribution',data);
    }
</script>
@endsection