@extends('cms.parent')

@section('page-name',__('cms.products'))
@section('main-page',__('cms.shop_content_management'))
@section('sub-page',__('cms.products'))
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

                   

                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.storehouse')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="store_house_id"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    @foreach ($sotreohuse as $s)
                                    <option value="{{$s->id}}" @selected($s->id == $product->store_house_id)>{{$s->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.storehouse')}}</span>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>

                    <x-input name="{{__('cms.name_ar')}}" type="text" id="name_ar" value="{{$product->name_ar}}"/>
                    <x-input name="{{__('cms.name_en')}}" type="text" id="name_en" value="{{$product->name_en}}" dir="ltr"/>

                        <x-input name="{{ __('cms.description_ar') }}" type="text" id="description_ar" value="{{$product->description_ar}}"/>
                        <x-input name="{{ __('cms.description_en') }}" type="text" id="description_en" dir="ltr" value="{{$product->description_en}}"/>


                    <x-input name="{{__('cms.item_count')}}" type="number" id="num_item" value="{{$product->num_items}}"/>
                        @foreach ($currency as $crr)
                        <x-input type="number" name="{{ __('cms.price') }} {{$crr->name}}" id="price_{{$crr->id}}" value="{{$product->price->where('currency_id',$crr->id)->first()?->price}}"/>
                            <x-input type="number" name="{{ __('cms.price') }} {{$crr->name}} / {{__('cms.joomla')}}" id="price_joomla_{{$crr->id}}" value="{{$product->joomla->where('currency_id',$crr->id)->first()?->price}}"/>

                    @endforeach  
                    <div class="form-group row mt-4">
                        <label class="col-3 col-form-label">{{__('cms.type')}}:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropdown bootstrap-select form-control dropup">
                                <select class="form-control selectpicker" data-size="7" id="type"
                                    title="Choose one of the following..." tabindex="null" data-live-search="true">
                                    <option value="user" @selected($product->type == 'user')>{{__('cms.user')}}</option>
                                    <option value="studio" @selected($product->type == 'studio')>{{__('cms.studio')}}</option>
                                </select>
                            </div>
                            <span class="form-text text-muted">{{__('cms.please_select')}}
                                {{__('cms.type')}}</span>
                        </div>
                    </div>
                    <x-image id="image" value="{{Storage::url($product->image)}}"/>


                    <div class="separator separator-dashed my-10"></div>
                    <h3 class="text-dark font-weight-bold mb-10">{{__('cms.settings')}}</h3>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">{{__('cms.active')}}</label>
                        <div class="col-3">
                            <span class="switch switch-outline switch-icon switch-success">
                                <label>
                                    <input type="checkbox" @checked($product->active) id="active">
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
    var cover = new KTImageInput('kt_image_image');
</script>
<script>
  

    function performEdit(){

        // Edit Products

        let formData = new FormData();
        let currences = [
                @foreach ($currency as $crr)
                {
                    currncyId : {{$crr->id}},
                    value : document.getElementById('price_{{$crr->id}}').value,
                },
                @endforeach
            ];


            let currencesJoomla = [
                @foreach ($currency as $crr)
                {
                    currncyId : {{$crr->id}},
                    value : document.getElementById('price_joomla_{{$crr->id}}').value,
                },
                @endforeach
            ];
        formData.append('price_joomla', JSON.stringify(currencesJoomla));
        formData.append('description_ar', document.getElementById('description_ar').value);
            formData.append('description_en', document.getElementById('description_en').value);
        formData.append('price', JSON.stringify(currences));
            formData.append('name_ar',document.getElementById('name_ar').value);
            formData.append('name_en',document.getElementById('name_en').value);
            formData.append('num_item',document.getElementById('num_item').value);
            formData.append('type',document.getElementById('type').value);
            formData.append('store_house_id',document.getElementById('store_house_id').value);
            formData.append('image',document.getElementById('image').files[0] ? document.getElementById('image').files[0] : '');
            formData.append('active',document.getElementById('active').checked?1:0);
            formData.append('_method','put');

           store('/cms/admin/products/{{$product->id}}', formData,'/cms/admin/products');


  }
</script>
@endsection