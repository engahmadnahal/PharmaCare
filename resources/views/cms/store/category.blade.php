@extends('cms.parent')

@section('page-name', __('cms.category_store'))
@section('main-page', __('cms.content_management'))
@section('sub-page', __('cms.category_store'))
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



                        <div id="category">

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
        let categories = [];
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

            axios.get('/cms/admin/stores/{{$store->id}}/get-categories/' + lang).then(function(response) {

                $('#category').html('');
                if (response.data.data.length != 0) {
                    console.log(response.data.data);
                    response.data.data.map((cat, i) => {
                        categories.push({
                            category_id: cat.id,
                            isSelect : false
                        });

                        $('#category').append(`
                            <div class="form-group row mt-4">
                                    <label class="col-3 col-form-label" id="cat_${cat.id}">${cat.title} :</label>
                                        <div class="col-3">
                                            <span class="switch switch-outline switch-icon switch-success">
                                                <label>
                                                    <input type="checkbox" ${cat.selected ? 'checked="checked"' : ''}   class="selectCategory" value="${cat.id}">
                                                    <span></span>
                                                </label>
                                            </span>
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
            let data = $('.selectCategory:checked').map(function(){
                return this.value;
            }).get();

            let formData = new FormData();
            formData.append('categories', data);
            @if(auth('admin')->check())
            store('/cms/admin/stores/categories/{{$store->id }}', formData,'/cms/admin/stores');
            @else
            store('/cms/admin/stores/categories/{{$store->id }}', formData,'/cms/admin/');
            @endif
        }
    </script>
@endsection
