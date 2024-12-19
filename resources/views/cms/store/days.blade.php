@extends('cms.parent')

@section('page-name', __('cms.day'))
@section('main-page', __('cms.content_management'))
@section('sub-page', __('cms.day'))
@section('page-name-small', __('cms.create'))

@section('styles')

@endsection

@section('content')
    <!--begin::Container-->
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('cms.create_update') }}
                    </h3>
                   
                </div>
                <!--begin::Form-->
                <form id="create-form">
                    <div class="card-body">
                        <div class="form-group row mt-4">
                            <label class="col-3 col-form-label">{{ __('cms.language') }}:<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-4 col-md-9 col-sm-12">
                                <div class="dropdown bootstrap-select form-control dropup">
                                    <select class="form-control selectpicker" data-size="7" id="language"
                                        title="Choose one of the following..." tabindex="null" data-live-search="true">
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="form-text text-muted">{{ __('cms.please_select') }}
                                    {{ __('cms.type') }}</span>
                            </div>
                        </div>


                   
                        <div id="daysWork">
                           
                        </div>




                        <div class="separator separator-dashed my-10"></div>

                    </div>


                    
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-3">

                            </div>
                            <div class="col-9">
                                <button type="button" onclick="performStore()" id="btnStore"
                                    class="btn btn-primary mr-2">{{ __('cms.save') }}</button>
                                <button type="reset" class="btn btn-secondary">{{ __('cms.cancel') }}</button>
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
        let days = [];
        controlFormInputs(true);
        $('#language').on('change', function() {
            getDataForLang(this.value);
            controlFormInputs(this.value == -1);
        });

        function controlFormInputs(disabled) {
            $('#btnStore').attr('disabled', disabled);
        }

        function getDataForLang(lang) {
            blockUI();

            axios.get('/cms/admin/stores/get-daywork/' + lang).then(function(response) {
                
                $('#daysWork').html('');
                if (response.data.data.length != 0) {

                    response.data.data.map((day,i) => {
                        days.push({
                            day_id : day.day_id,
                            start_time : 0,
                            close_time : 0,
                            note : ''
                        });

                        $('#daysWork').append(`
                            <div class="form-group row mt-4">
                                    <label class="col-3 col-form-label" id="day_${day.day_id}">${day.name} :</label>
                                    <div class="col-3">
                                        <input type="time" class="form-control" id="start_time_${day.day_id}" placeholder="{{__('cms.start_time')}}" />
                                        <span class="form-text text-muted">{{ __('cms.please_enter') }} {{__('cms.start_time')}}</span>
                                    </div>
                                    <div class="col-3">
                                        <input type="time" class="form-control" id="close_time_${day.day_id}" placeholder="{{__('cms.close_time')}}"/>
                                        <span class="form-text text-muted">{{ __('cms.please_enter') }} {{__('cms.close_time')}}</span>
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" id="note_${day.day_id}" placeholder="{{__('cms.note')}}"/>
                                        <span class="form-text text-muted">{{ __('cms.please_enter') }} {{__('cms.note')}}</span>
                                    </div>
                                </div>
                        `);
                    });

                } else {
                    controlFormInputs(true);
                    aletr('Some mandatory data, no translation available ');
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


        function performStore() {
            let data = [];
            for(day in days){
                let d = days[day];
                try{
                    let start = document.getElementById('start_time_'+d.day_id).value;
                    let close = document.getElementById('close_time_'+d.day_id).value;
                    let note = document.getElementById('note_'+d.day_id).value;
                    if(start != "" && close != "" && note != ""){
                        d.start_time = start;
                        d.close_time = close;
                        d.note = note;
                        data.push(d);
                    }
                }catch(e){
                    console.log('catch');
                    console.log(day);
                }

            }
            let formData = new FormData();
            formData.append('day',JSON.stringify(data));
            formData.append('language_id',document.getElementById('language').value);
            store('/cms/admin/stores/daywork/{{$store->id}}', formData);
        }
    </script>
@endsection
