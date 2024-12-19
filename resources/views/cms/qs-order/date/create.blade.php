@extends('cms.parent')

@section('page-name',__('cms.qs_general'))
@section('main-page',__('cms.settings'))
@section('sub-page',__('cms.qs_general'))
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
                <h3 class="card-title">{{__('cms.create')}}</h3>
                
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.qs_ar')}}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="qs_ar" placeholder="{{__('cms.qs_ar')}}" />
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.qs_ar')}}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.qs_en')}}:</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="qs_en" placeholder="{{__('cms.qs_en')}}" dir="ltr"/>
                            <span class="form-text text-muted">{{__('cms.please_enter')}} {{__('cms.qs_en')}}</span>
                        </div>
                    </div>

                    @foreach ($currency as $crr)
                    <x-input type="number" name="{{ __('cms.price') }} {{$crr->name}}" id="price_{{$crr->id}}" />
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
    var cover = new KTImageInput('kt_image_6');
    
    function performStore(){
        let formData = new FormData();
        let currences = [
                @foreach ($currency as $crr)
                {
                    currncyId : {{$crr->id}},
                    value : document.getElementById('price_{{$crr->id}}').value,
                },
                @endforeach
            ];
        formData.append('price', JSON.stringify(currences));
        formData.append('qs_ar',document.getElementById('qs_ar').value);
        formData.append('qs_en',document.getElementById('qs_en').value);
        store('/cms/admin/qs_date_orders',formData);
    }
</script>
@endsection