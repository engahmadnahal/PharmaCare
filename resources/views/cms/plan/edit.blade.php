@extends('cms.parent')

@section('page-name',__('cms.days'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.days'))
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
                <h3 class="card-title">@empty($planTrans) {{__('cms.update')}} @else {{__('cms.add_trans')}} @endempty </h3>
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
                    @empty($plan)
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.language')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="language"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($languages as $language)
                                            <option value="{{$language->id}}" @selected($language->id == $planTrans->language_id)>{{$language->name}}</option>
                                      
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.type')}}</span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    
                    <x-input id="name" type="text" name="{{ __('cms.name') }}" value="{{$planTrans->name}}"/>
                    <x-input id="description" type="text" name="{{ __('cms.description') }}" value="{{$planTrans->description}}"/>
                    
                    @else


                    <x-input id="price" type="number" name="{{ __('cms.price') }}"  value="{{$plan->price}}"/>
                    <x-input id="max_month" type="number" name="{{ __('cms.max_month') }}"  value="{{$plan->max_month}}"/>
                    <x-input id="discount_value" type="number" name="{{ __('cms.discount_value') }}" value="{{$plan->discount_value}}"/>


                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.settings')}}</h3>

                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.active')}}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" @checked($plan->active) id="active">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                @endempty
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            @empty($plan)
                            <button type="button" onclick="performEdit()"
                                class="btn btn-primary mr-2">{{__('cms.save')}}</button>
                                @else
                                <button type="button" onclick="performEditPlan()"
                                    class="btn btn-primary mr-2">{{__('cms.save')}}</button>
                            @endempty
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
    @empty($plan)
    function performEdit(){
        blockUI();
        let data = {
            language: document.getElementById('language').value,
            name: document.getElementById('name').value,
            description: document.getElementById('description').value,
        }
        update('/cms/admin/plans/translations/{{$planTrans->id}}', data, '/cms/admin/plans');
    }
    @else

    function performEditPlan(){
    blockUI();
        let data = {
            discount_value : document.getElementById('discount_value').value,
            price : document.getElementById('price').value,
            max_month : document.getElementById('max_month').value,
            active : document.getElementById('active').checked,
        }
        update('/cms/admin/plans/{{$plan->id}}',data,'/cms/admin/plans');
    }

    @endempty

    
</script>
@endsection