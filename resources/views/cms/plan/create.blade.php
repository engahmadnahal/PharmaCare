@extends('cms.parent')

@section('page-name',__('cms.plans'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.plans'))
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
                <h3 class="card-title">@empty($plan) {{__('cms.create')}} @else {{__('cms.add_trans')}} @endempty</h3>
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
                    <div class="separator separator-dashed my-10"></div>
                    
                    <x-input id="name" type="text" name="{{ __('cms.name') }}" />
                    <x-input id="description" type="text" name="{{ __('cms.description') }}" />

                    @empty($plan)
                    <x-input id="max_month" type="number" name="{{ __('cms.max_month') }}"  />
                    <x-input id="price" type="number" name="{{ __('cms.price') }}" />
                    <x-input id="discount_value" type="number" name="{{ __('cms.discount_value') }}" />

                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.settings')}}</h3>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.active')}}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" checked="checked" id="active">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                @endempty

                
                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="performStore({{$plan->id ?? null}})"
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
    controlFormInputs(true);
    $('#language').on('change',function() {
            controlFormInputs(this.value == -1);
    });

    function controlFormInputs(disabled) {
        $('#name').attr('disabled',disabled);
        $('#description').attr('disabled',disabled);
        $('#discount_value').attr('disabled',disabled);
        $('#price').attr('disabled',disabled);
        $('#max_month').attr('disabled',disabled);
        
    }

  
    function blockUI () {
        KTApp.blockPage({
            overlayColor: 'blue',
            opacity: 0.1,
            state: 'primary' // a bootstrap color
        });
    }

    function unBlockUI () {
        KTApp.unblockPage();
    }

</script>
<script>
    function performStore(id){
        let data = {
            language: document.getElementById('language').value,
            name: document.getElementById('name').value,
            description: document.getElementById('description').value,
            @empty($plan)
            discount_value: document.getElementById('discount_value').value,
            max_month: document.getElementById('max_month').value,
            
            price: document.getElementById('price').value,
            active : document.getElementById('active').checked
            @endempty
        }

        if(id == null) {
            store('/cms/admin/plans',data);
        }else {
            store('/cms/admin/plans/'+id+'/translation',data);
        }
    }
</script>
@endsection