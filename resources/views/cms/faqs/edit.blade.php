@extends('cms.parent')

@section('page-name',__('cms.faqs'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.faqs'))
@section('page-name-small',__('cms.update'))

@section('styles')

@endsection

@section('content')
<!--begin::Container-->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title"></h3>
               
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">
                    <x-input name="{{__('cms.title_ar')}}" type="text" id="title_ar" value="{{$data->title_ar}}"/>
                    <x-input name="{{__('cms.title_en')}}" type="text" id="title_en" value="{{$data->title_ar}}"/>

                    <x-input name="{{__('cms.qs_ar')}}" type="text" id="qs_ar" value="{{$data->qs_ar}}"/>
                    <x-input name="{{__('cms.qs_en')}}" type="text" id="qs_en" value="{{$data->qs_en}}"/>

                    <x-textarea name="{{__('cms.answer_ar')}}" type="text" id="answer_ar" value="{{$data->answer_ar}}"/>
                    <x-textarea name="{{__('cms.answer_en')}}" type="text" id="answer_en" value="{{$data->answer_en}}"/>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="performEdit()"
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
    function performEdit(){
        let data = {
            qs_ar: document.getElementById('qs_ar').value,
            qs_en: document.getElementById('qs_en').value,
            answer_ar: document.getElementById('answer_ar').value,
            answer_en: document.getElementById('answer_en').value,
            title_ar: document.getElementById('title_ar').value,
            title_en: document.getElementById('title_en').value,
        }
        update('/cms/admin/faqs/{{$data->id}}', data, '/cms/admin/faqs');
    }
</script>
@endsection