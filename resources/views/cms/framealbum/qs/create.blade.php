@extends('cms.parent')

@section('page-name',__('cms.qs_frames_album'))
@section('main-page',__('cms.services'))
@section('sub-page',__('cms.qs_frames_album'))
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
                <h3 class="card-title"></h3>
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.options')}}:<span
                                class="text-danger">*</span></label>

                                
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="frames_or_album_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($frameOrAlbum as $s)
                                        <option value="{{$s->id}}">{{$s->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.options')}}</span>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.type')}}:<span
                                class="text-danger">*</span></label>

                                
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="type"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                        <option value="yesOrNo">{{__('cms.yesOrNo')}}</option>
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.type')}}</span>
                        </div>
                    </div>

                    
                    <div class="separator separator-dashed my-10"></div>
                   

                    <x-input type="text" name="{{__('cms.qs_ar')}}" id="qs_ar" />
                    <x-input type="text"  name="{{__('cms.qs_en')}}" id="qs_en" dir="ltr"/>
                    {{-- @foreach ($currency as $crr)
                    <x-input type="number" name="{{ __('cms.price') }} {{$crr->name}}" id="price_{{$crr->id}}" />
                @endforeach                     --}}

                    

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
        // let currences = [
        //         @foreach ($currency as $crr)
        //         {
        //             currncyId : {{$crr->id}},
        //             value : document.getElementById('price_{{$crr->id}}').value,
        //         },
        //         @endforeach
        //     ];

            let data = {
                // price : currences,
                frames_or_album_id : document.getElementById('frames_or_album_id').value,
                type : document.getElementById('type').value,
                qs_ar : document.getElementById('qs_ar').value,
                qs_en : document.getElementById('qs_en').value,
            };

        // formData.append('price', JSON.stringify(currences));
        // formData.append('frames_or_album_id',document.getElementById('frames_or_album_id').value);
        // formData.append('type',document.getElementById('type').value);
        // formData.append('qs_ar',document.getElementById('qs_ar').value);
        // formData.append('qs_en',document.getElementById('qs_en').value);
        store('/cms/admin/qs_frames_albums',data);
    }
</script>
@endsection