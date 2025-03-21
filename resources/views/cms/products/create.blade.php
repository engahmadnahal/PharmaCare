@extends('cms.parent')

@section('page-name', __('cms.products'))
@section('main-page', __('cms.pharmacy_management'))
@section('sub-page', __('cms.products'))
@section('page-name-small', __('cms.create'))

@section('styles')
<link href="{{asset('cms/css/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">{{__('cms.create_product')}}</h3>
    </div>
    <!--begin::Form-->
    <form id="create-form">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.category')}}:<span class="text-danger">*</span></label>
                        <select class="form-control" id="category_id">
                            <option value="">{{__('cms.select_category')}}</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.medicine_type')}}:<span class="text-danger">*</span></label>
                        <select class="form-control" id="medicine_type_id">
                            <option value="">{{__('cms.select_medicine_type')}}</option>
                            @foreach($medicineTypes as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.barcode')}}:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="barcode" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.concentration')}}:<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="concentration_value" />
                            <select class="form-control" id="concentration_unit">
                                @foreach($concentrationUnits as $unit)
                                <option value="{{$unit}}">{{$unit}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trade Name -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.trade_name_ar')}}:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="trade_name_ar" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.trade_name_en')}}:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="trade_name_en" />
                    </div>
                </div>
            </div>

            <!-- Scientific Name -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.scientific_name_ar')}}:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="scientific_name_ar" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.scientific_name_en')}}:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="scientific_name_en" />
                    </div>
                </div>
            </div>

            <!-- Description Fields -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.drug_description_ar')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="drug_description_ar" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.drug_description_en')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="drug_description_en" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <!-- Usage Information -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.indications_for_use_ar')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="indications_for_use_ar" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.indications_for_use_en')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="indications_for_use_en" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <!-- Recommended Dosage -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.recommended_dosage_ar')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="recommended_dosage_ar" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.recommended_dosage_en')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="recommended_dosage_en" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <!-- How to Use -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.how_to_use_ar')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="how_to_use_ar" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.how_to_use_en')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="how_to_use_en" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <!-- Drug Interactions -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.drug_interactions_ar')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="drug_interactions_ar" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.drug_interactions_en')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="drug_interactions_en" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <!-- Side Effects -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.side_effects_ar')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="side_effects_ar" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.side_effects_en')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="side_effects_en" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <!-- Alternative Medicines -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.alternative_medicines_ar')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="alternative_medicines_ar" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.alternative_medicines_en')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="alternative_medicines_en" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <!-- Complementary Medicines -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.complementary_medicines_ar')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="complementary_medicines_ar" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.complementary_medicines_en')}}:<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="complementary_medicines_en" rows="3"></textarea>
                    </div>
                </div>
            </div>


            <!-- Numeric Fields -->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{__('cms.num_units_in_package')}}:<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="num_units_in_package" min="1" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{__('cms.quantity')}}:<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="quantity" min="1" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>{{__('cms.weight')}}:<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="weight" min="1" />
                    </div>
                </div>
            </div>

            <!-- Pricing -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.basic_price')}}:<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="basic_price" min="1" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.retail_price')}}:<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="retail_price" min="1" />
                    </div>
                </div>
            </div>

            <!-- Date and Prescription -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.expiration_date')}}:<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="expiration_date" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.prescription_required')}}:</label>
                        <div class="switch switch-outline switch-icon switch-primary">
                            <label>
                                <input type="checkbox" id="available_without_prescription" />
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Images -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.product_image')}}:<span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" accept="image/*" />
                            <label class="custom-file-label">{{__('cms.choose_file')}}</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.leaflet_image')}}:<span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="medication_leaflet_image" accept="image/*" />
                            <label class="custom-file-label">{{__('cms.choose_file')}}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="button" onclick="performStore()" class="btn btn-primary mr-2">{{__('cms.save')}}</button>
            <button type="reset" class="btn btn-secondary">{{__('cms.cancel')}}</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    function performStore() {
        let formData = new FormData();
        formData.append('category_id', document.getElementById('category_id').value);
        formData.append('medicine_type_id', document.getElementById('medicine_type_id').value);
        formData.append('barcode', document.getElementById('barcode').value);
        formData.append('trade_name_ar', document.getElementById('trade_name_ar').value);
        formData.append('trade_name_en', document.getElementById('trade_name_en').value);
        formData.append('scientific_name_ar', document.getElementById('scientific_name_ar').value);
        formData.append('scientific_name_en', document.getElementById('scientific_name_en').value);
        formData.append('drug_description_ar', document.getElementById('drug_description_ar').value);
        formData.append('drug_description_en', document.getElementById('drug_description_en').value);
        formData.append('indications_for_use_ar', document.getElementById('indications_for_use_ar').value);
        formData.append('indications_for_use_en', document.getElementById('indications_for_use_en').value);
        formData.append('recommended_dosage_ar', document.getElementById('recommended_dosage_ar').value);
        formData.append('recommended_dosage_en', document.getElementById('recommended_dosage_en').value);
        formData.append('how_to_use_ar', document.getElementById('how_to_use_ar').value);
        formData.append('how_to_use_en', document.getElementById('how_to_use_en').value);
        formData.append('drug_interactions_ar', document.getElementById('drug_interactions_ar').value);
        formData.append('drug_interactions_en', document.getElementById('drug_interactions_en').value);
        formData.append('side_effects_ar', document.getElementById('side_effects_ar').value);
        formData.append('side_effects_en', document.getElementById('side_effects_en').value);
        formData.append('alternative_medicines_ar', document.getElementById('alternative_medicines_ar').value);
        formData.append('alternative_medicines_en', document.getElementById('alternative_medicines_en').value);
        formData.append('complementary_medicines_ar', document.getElementById('complementary_medicines_ar').value);
        formData.append('complementary_medicines_en', document.getElementById('complementary_medicines_en').value);
        formData.append('concentration_value', document.getElementById('concentration_value').value);
        formData.append('concentration_unit', document.getElementById('concentration_unit').value);
        formData.append('num_units_in_package', document.getElementById('num_units_in_package').value);
        formData.append('available_without_prescription', document.getElementById('available_without_prescription').checked ? 1 : 0);
        formData.append('quantity', document.getElementById('quantity').value);
        formData.append('basic_price', document.getElementById('basic_price').value);
        formData.append('retail_price', document.getElementById('retail_price').value);
        formData.append('expiration_date', document.getElementById('expiration_date').value);
        formData.append('weight', document.getElementById('weight').value);

        let imageFile = document.getElementById('image').files[0];
        let leafletFile = document.getElementById('medication_leaflet_image').files[0];

        if (imageFile) {
            formData.append('image', imageFile);
        }

        if (leafletFile) {
            formData.append('medication_leaflet_image', leafletFile);
        }

        axios.post('/cms/employee/products', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(function(response) {
                toastr.success(response.data.message);
                window.location.href = '/cms/employee/products';
            })
            .catch(function(error) {
                toastr.error(error.response.data.message);
            });
    }
</script>
@endsection