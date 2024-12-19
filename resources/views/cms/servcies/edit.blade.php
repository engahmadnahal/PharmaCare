@extends('cms.parent')

@section('page-name',__('cms.serviceStudio'))
@section('main-page',__('cms.content_management'))
@section('sub-page',__('cms.serviceStudio'))
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
                <h3 class="card-title"></h3>
            </div>
            <!--begin::Form-->
            <form id="create-form">
                <div class="card-body">
                   
                    <x-input name="{{__('cms.name_ar')}}" type="text" id="name_ar" value="{{$serviceStudio->name_ar}}"/>
                    <x-input name="{{__('cms.name_en')}}" type="text" id="name_en" value="{{$serviceStudio->name_en}}"/>
                        {{-- @foreach ($currency as $crr)
                        <x-input type="number" name="{{ __('cms.price') }} {{$crr->name}}" id="price_{{$crr->id}}" value="{{$serviceStudio->price->where('currency_id',$crr->id)->first()?->price}}"/>
                    @endforeach   --}}

                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.settings')}}</h3>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.active')}}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" @checked($serviceStudio->active) id="active">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-9">
                            <button type="button" onclick="performEdit({{$serviceStudio->id}})"
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
    function performEdit(){
        blockUI();
        // let currences = [
        //         @foreach ($currency as $crr)
        //         {
        //             currncyId : {{$crr->id}},
        //             value : document.getElementById('price_{{$crr->id}}').value,
        //         },
        //         @endforeach
        //     ];
        let data = {
            // price : JSON.stringify(currences),
            name_ar: document.getElementById('name_ar').value,
            name_en: document.getElementById('name_en').value,
            active: document.getElementById('active').checked,
        }
        update('/cms/admin/service_studios/{{$serviceStudio->id}}', data, '/cms/admin/service_studios');
    }
</script>
@endsection