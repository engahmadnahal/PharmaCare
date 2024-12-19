@extends('cms.parent')

@section('page-name',__('cms.delivary'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.delivary'))
@section('page-name-small',__('cms.create'))

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
                <h3 class="card-title"> {{__('cms.create')}} </h3>
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
                        <label class="col-3 col-form-label">{{__('cms.language')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="language"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($languages as $language)
                                        <option value="{{$language->id}}">{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.type')}}</span>
                        </div>
                    </div>

                    <x-input id="price" type="text" name="{{ __('cms.price') }}" />
                    <x-input id="duration_num" type="text" name="{{ __('cms.duration_num') }}" />

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.duration_type')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="duration_type"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                        <option value="houre">{{__('cms.houre')}}</option>
                                        <option value="day">{{__('cms.day')}}</option>
                                        <option value="week">{{__('cms.week')}}</option>
                                        <option value="month">{{__('cms.month')}}</option>
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.duration_type')}}</span>
                        </div>
                    </div>
                    
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{ __('cms.regions') }}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="region"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    {{-- @foreach ($regions as $r)
                                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach --}}
                                </select>
                            </div>
                            <span class="form-text text-muted">{{ __('cms.please_select') }}
                                {{ __('cms.regions') }}</span>
                        </div>
                    </div>
                   

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
    var image = new KTImageInput('kt_image_5');
    controlFormInputs(true);
    $('#language').on('change', function() {
        getDataForLang(this.value);
        controlFormInputs(this.value == -1);
    });

    function controlFormInputs(disabled) {
        $('#region').attr('disabled', disabled);
        $('#price').attr('disabled', disabled);
        $('#duration_num').attr('disabled', disabled);
        $('#duration_type').attr('disabled', disabled);
    }

    function getDataForLang(lang) {
        blockUI();
        axios.post('/cms/admin/store_delivary_balances/data-for-lang', {
            lang_id: lang
        }).then(function(response) {
            console.log(response.data.data);
            if (response.data.data.regions.length != 0) {
                response.data.data.regions.map((region) => {
                    $('#region').append(new Option(region.name, region.region_id));
                    $('#region').selectpicker("refresh");
                    $('#duration_type').selectpicker("refresh");
                    
                });

            } else {
                controlFormInputs(true);
            }
            

        }).catch(function(error) {});
        unBlockUI();
    }


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
</script>
<script>
    function performStore(){
        let data = {
            price : document.getElementById('price').value,
            duration_num : document.getElementById('duration_num').value,
            duration_type : document.getElementById('duration_type').value,
            region : document.getElementById('region').value,
        };
        store('/cms/admin/store_delivary_balances',data);
    }
</script>
@endsection