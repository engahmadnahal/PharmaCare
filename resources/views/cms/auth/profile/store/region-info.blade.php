@extends('cms.auth.profile.profile')

@section('profile-content')
<div class="flex-row-fluid ml-lg-8">
    <!--begin::Card-->
    <div class="card card-custom card-stretch">
        <!--begin::Header-->
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">{{__('cms.image-cover')}}</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">---</span>
            </div>
            <div class="card-toolbar">
                <button type="button"
                    onclick="performEdit()"
                    class="btn btn-success mr-2">{{__('cms.save')}}</button>
                <button type="reset" class="btn btn-secondary">{{__('cms.cancel')}}</button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form class="form">
            <!--begin::Body-->
            <div class="card-body">
                <div class="row">
                    <label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6">
                        <h5 class="font-weight-bold mb-6">{{__('cms.info')}}</h5>
                    </div>
                </div>
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
                <div class="separator separator-dashed my-10"></div>
                <div class="form-group row mt-4">
                    <label class="col-3 col-form-label">{{ __('cms.regions') }}:</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="dropdown bootstrap-select form-control dropup">
                            <select class="form-control selectpicker" data-size="7" id="region" tabindex="null" data-live-search="true">
                                <option value="{{ auth()->user()->region->id }}">{{ auth()->user()->region->name }}</option>
                            </select>
                        </div>
                        <span class="form-text text-muted">{{ __('cms.please_select') }}
                            {{ __('cms.regions') }}</span>
                    </div>
                </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{__('cms.longitude')}}</label>
                        <div class="col-lg-9 col-xl-6">
                            <input type="text" class="form-control form-control-lg form-control-solid" value="{{auth()->user()->longitude}}"
                                id="longitude" placeholder="{{__('cms.longitude')}}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label text-alert">{{__('cms.latitude')}}</label>
                        <div class="col-lg-9 col-xl-6">
                            <input type="text" class="form-control form-control-lg form-control-solid" value="{{auth()->user()->latitude}}"
                                id="latitude" placeholder="{{__('cms.latitude')}}" />
                        </div>
                    </div>
                
                
            </div>
            <!--end::Body-->
        </form>
        <!--end::Form-->
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('cms/assets/js/pages/crud/file-upload/image-input.js')}}"></script>

<script>
    var image = new KTImageInput('profile_image');
    var image = new KTImageInput('cover_image');
    controlFormInputs(true);
        $('#language').on('change', function() {
            $('#region').html('');
            getDataForLang(this.value);
            controlFormInputs(this.value == -1);
        });

        function controlFormInputs(disabled) {
            $('#longitude').attr('disabled', disabled);
            $('#latitude').attr('disabled', disabled);
            $('#region').attr('disabled', disabled);
        }

        function getDataForLang(lang) {
            blockUI();
            
            axios.post('/cms/admin/stores/data-for-lang', {
                lang_id: lang
            }).then(function(response) {
                if (response.data.data.regions.length != 0) {
                    response.data.data.regions.map((region) => {
                        $('#region').append(new Option(region.name, region.region_id));
                        $('#region').selectpicker("refresh");
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

        function performEdit(){
            let formData = new FormData();
                formData.append('_method', 'PUT');
                formData.append('longitude',document.getElementById('longitude').value);
                formData.append('latitude',document.getElementById('latitude').value);
                formData.append('region',document.getElementById('region').value);
                store('/cms/admin/profile/region-info', formData);

       
        }
        

   
</script>
@endsection