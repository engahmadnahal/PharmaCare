@extends('cms.parent')

@section('page-name',__('cms.PromoCode'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.PromoCode'))
@section('page-name-small',__('cms.create'))

@section('styles')

@endsection

@section('content')
<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">{{__('cms.create')}}  </h3>
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">
                    
                        <div class="form-group row mt-4">
                            <label class="col-3 col-form-label">{{__('cms.type')}}:<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-4 col-md-9 col-sm-12">
                                <div class="dropdown bootstrap-select form-control dropup">
                                    <select class="form-control selectpicker" data-size="3" id="type"
                                        title="Choose one of the following..." tabindex="null" data-live-search="true">
                                        <option value="fixed">{{__('cms.fixed')}}</option>
                                        <option value="percent">{{__('cms.percent')}}</option>
                                    </select>
                                </div>
                                <span class="form-text text-muted">{{__('cms.please_select')}}
                                    {{__('cms.type')}}</span>
                            </div>
                        </div>

                        <x-input id="value" type="number" name="{{ __('cms.value') }}" />
                        <x-input id="max_usege" type="number" name="{{ __('cms.all_beneficiaries') }}" />
                        <x-input id="start" type="date" name="{{ __('cms.start_date') }}" />
                        <x-input id="end" type="date" name="{{ __('cms.end_date') }}" />
                        <x-input id="code" type="text" name="{{ __('cms.code') }}" />

                        <x-input id="title_ar" type="text" name="{{ __('cms.title_ar') }}" />
                        <x-input id="title_en" type="text" name="{{ __('cms.title_en') }}" />

                        @foreach ($currency as $crr)
                        <x-input type="text" name="{{ __('cms.price') }} {{$crr->name}}" id="min_balance_{{$crr->id}}" />
                    @endforeach
    

    
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
    function performStore(){

        let min_balance = [
            @foreach ($currency as $crr)
            {
                currncyId : {{$crr->id}},
                value : document.getElementById('min_balance_{{$crr->id}}').value,
            },
            @endforeach
        ];

        let data = {
            min_balance : min_balance,
            value : document.getElementById('value').value,
            max_usege : document.getElementById('max_usege').value,
            start : document.getElementById('start').value,
            end : document.getElementById('end').value,
            type : document.getElementById('type').value,
            title_ar : document.getElementById('title_ar').value,
            title_en : document.getElementById('title_en').value,
            code : document.getElementById('code').value,
            
        };
        store('/cms/admin/promo_codes',data);
    }
</script>
@endsection