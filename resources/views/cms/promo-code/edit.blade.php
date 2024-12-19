@extends('cms.parent')

@section('page-name',__('cms.PromoCode'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.PromoCode'))
@section('page-name-small',__('cms.update'))

@section('styles')

@endsection

@section('content')
<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">
       {{-- {{dd(isset($data['country']));}} --}}
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title"> {{__('cms.update')}} </h3>
                {{-- <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                    </div>
                </div> --}}
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
                                    <option value="fixed" @selected($data->type == "fixed")>{{__('cms.fixed')}}</option>
                                    <option value="percent" @selected($data->type == "percent")>{{__('cms.percent')}}</option>
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.type')}}</span>
                        </div>
                    </div>
                    
                    <x-input id="value" type="number" name="{{ __('cms.value') }}" value="{{$data->value}}"/>
                    <x-input id="max_usege" type="number" name="{{ __('cms.all_beneficiaries') }}" value="{{$data->max_usege}}"/>
                        {{-- <x-input id="min_balance" type="number" name="{{ __('cms.min_balance') }}" value="{{$data->min_balance}}"/> --}}
                    <x-input id="start" type="date" name="{{ __('cms.start_date') }}" value="{{$data->start}}"/>
                    <x-input id="end" type="date" name="{{ __('cms.end_date') }}" value="{{$data->end}}"/>
                    <x-input id="code" type="text" name="{{ __('cms.code') }}" value="{{$data->code}}"/>

                    <x-input id="title_ar" type="text" name="{{ __('cms.title_ar') }}" value="{{$data->title_ar}}"/>
                    <x-input id="title_en" type="text" name="{{ __('cms.title_en') }}" value="{{$data->title_en}}"/>


                         @foreach ($currency as $crr)
                        <x-input type="text" name="{{ __('cms.price') }} {{$crr->name}}" id="min_balance_{{$crr->id}}" value="{{$data->price->where('currency_id',$crr->id)->first()?->price}}"/>
                    @endforeach



                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="performUpdate()"
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
    function performUpdate(){


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

        update('/cms/admin/promo_codes/{{$data->id}}', data, '/cms/admin/promo_codes');
    }
</script>
@endsection