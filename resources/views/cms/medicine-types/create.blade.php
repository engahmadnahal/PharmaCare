@extends('cms.parent')

@section('page-name',__('cms.create_medicine_type'))
@section('main-page',__('cms.medicine_types'))
@section('sub-page',__('cms.create'))

@section('styles')
<!-- No additional styles needed for this simple form -->
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">{{__('cms.create_medicine_type')}}</h3>
    </div>

    <form id="create-form">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.name_ar')}}:</label>
                        <input type="text" class="form-control" id="name_ar" 
                            placeholder="{{__('cms.enter_name_ar')}}"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.name_en')}}:</label>
                        <input type="text" class="form-control" id="name_en" 
                            placeholder="{{__('cms.enter_name_en')}}"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.status')}}:</label>
                        <div class="radio-inline">
                            <label class="radio">
                                <input type="radio" name="status" id="status_active" value="1" checked/>
                                <span></span>
                                {{__('cms.active')}}
                            </label>
                            <label class="radio">
                                <input type="radio" name="status" id="status_inactive" value="0"/>
                                <span></span>
                                {{__('cms.inactive')}}
                            </label>
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
function performStore() {
    axios.post('/cms/admin/medicine-types', {
        name_ar: document.getElementById('name_ar').value,
        name_en: document.getElementById('name_en').value,
        status: document.querySelector('input[name="status"]:checked').value
    })
    .then(function (response) {
        toastr.success(response.data.message);
        window.location.href = '/cms/admin/medicine-types';
    })
    .catch(function (error) {
        if (error.response && error.response.data && error.response.data.message) {
            toastr.error(error.response.data.message);
        } else {
            toastr.error('An error occurred');
        }
    });
}
</script>
@endsection