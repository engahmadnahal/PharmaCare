@extends('cms.parent')

@section('page-name',__('cms.album_sizes'))
@section('main-page',__('cms.services'))
@section('sub-page',__('cms.album_sizes'))
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
                <h3 class="card-title">{{__('cms.update')}}</h3>
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
                        <label class="col-3 col-form-label">{{ __('cms.products') }}:<span
                                class="text-danger">*</span></label>

                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="product_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($products as $prd)
                                        <option value="{{ $prd->id }}" @selected($prd->id == $data->product_id)>
                                            {{ $prd->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{ __('cms.please_select') }}
                                {{ __('cms.products') }}</span>
                        </div>
                    </div>


                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.options')}}:<span
                                class="text-danger">*</span></label>

                                
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="frames_or_album_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($frameOrAlbum as $s)
                                        <option value="{{$s->id}}" @selected($s->id == $data->frames_or_album_id)>{{$s->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.size_or_type')}}</span>
                        </div>
                    </div>

                    
                    <div class="separator separator-dashed my-10"></div>
                    <x-input type="text" name="{{__('cms.width')}}" id="width" value="{{$data->width}}"/>
                    <x-input type="text"  name="{{__('cms.height')}}" id="height" value="{{$data->height}}" />
                    {{-- <x-input type="number" name="{{__('cms.num_photo')}}" id="num_photo" value="{{$data->num_photo}}"/> --}}
             
{{--                 
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{ __('cms.qs_booking') }}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="qs_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($qs as $q)
                                        <option value="{{ $q->id }}" @selected($q->id == $data->qsSize?->qs_frames_album_id)>
                                            {{ $q->qs }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{ __('cms.please_select') }}
                                {{ __('cms.qs') }}</span>
                        </div>
                    </div>

                    @foreach ($currency as $crr)
                        <x-input type="text" name="{{ __('cms.price') }} {{ $crr->name }}"
                            id="price_qs_{{ $crr->id }}"
                            value="{{ $sizeQsFrameAlbume?->price?->where('currency_id', $crr->id)->first()?->price }}" />
                    @endforeach --}}

                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="performEdit('{{$data->id}}')"
                                class="btn btn-primary mr-2">{{__('cms.update')}}</button>
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
    
    function performEdit(id){
        let formData = new FormData();
       

        // @foreach ($currency as $crr)
        //             formData.append('price_qs[{{$loop->index}}][currncyId]',{{$crr->id}});
        //             formData.append('price_qs[{{$loop->index}}][value]',document.getElementById('price_qs_{{$crr->id}}').value);
        //     @endforeach
        //     formData.append('qs_id', document.getElementById('qs_id').value);
        formData.append('frames_or_album_id',document.getElementById('frames_or_album_id').value);
        // formData.append('num_photo',document.getElementById('num_photo').value);
        formData.append('width',document.getElementById('width').value);
        formData.append('height',document.getElementById('height').value);
            formData.append('product_id', document.getElementById('product_id').value);
        formData.append('_method','put');
        store('/cms/admin/album_sizes/'+id, formData, '/cms/admin/album_sizes');
    }
</script>
@endsection