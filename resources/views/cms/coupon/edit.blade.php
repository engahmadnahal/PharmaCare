@extends('cms.parent')

@section('page-name',__('cms.edit_coupon'))
@section('main-page',__('cms.coupons'))
@section('sub-page',__('cms.edit'))

@section('styles')
<link href="{{asset('cms/css/datetimepicker.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">{{__('cms.edit_coupon')}}</h3>
    </div>

    <form id="edit-form">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.code')}}:</label>
                        <input type="text" class="form-control" id="code" 
                            value="{{$coupon->code}}"
                            placeholder="{{__('cms.enter_coupon_code')}}"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.discount')}}:</label>
                        <input type="number" class="form-control" id="discount" 
                            value="{{$coupon->discount}}"
                            placeholder="{{__('cms.enter_discount')}}" min="0" step="0.01"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.max_uses')}}:</label>
                        <input type="number" class="form-control" id="max_uses" 
                            value="{{$coupon->max_uses}}"
                            placeholder="{{__('cms.enter_max_uses')}}" min="1"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.status')}}:</label>
                        <div class="radio-inline">
                            <label class="radio">
                                <input type="radio" name="is_active" value="1" 
                                    {{$coupon->is_active ? 'checked' : ''}}/>
                                <span></span>
                                {{__('cms.active')}}
                            </label>
                            <label class="radio">
                                <input type="radio" name="is_active" value="0" 
                                    {{!$coupon->is_active ? 'checked' : ''}}/>
                                <span></span>
                                {{__('cms.inactive')}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.start_date')}}:</label>
                        <input type="datetime-local" class="form-control" id="start_date"
                            value="{{date('Y-m-d\TH:i', strtotime($coupon->start_date))}}"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.end_date')}}:</label>
                        <input type="datetime-local" class="form-control" id="end_date"
                            value="{{date('Y-m-d\TH:i', strtotime($coupon->end_date))}}"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="button" onclick="performUpdate()" class="btn btn-primary mr-2">{{__('cms.save')}}</button>
            <a href="{{route('cms.employee.coupons.index')}}" class="btn btn-secondary">{{__('cms.cancel')}}</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
function performUpdate() {
    axios.put('/cms/employee/coupons/{{$coupon->id}}', {
        code: document.getElementById('code').value,
        discount: parseFloat(document.getElementById('discount').value),
        max_uses: parseInt(document.getElementById('max_uses').value),
        start_date: document.getElementById('start_date').value,
        end_date: document.getElementById('end_date').value,
        is_active: document.querySelector('input[name="is_active"]:checked').value
    })
    .then(function (response) {
        toastr.success(response.data.message);
        window.location.href = '/cms/employee/coupons';
    })
    .catch(function (error) {
        if (error.response && error.response.data && error.response.data.message) {
            toastr.error(error.response.data.message);
        } else {
            toastr.error('An error occurred while updating the coupon');
        }
    });
}

// Initialize datetime inputs with proper format
document.addEventListener('DOMContentLoaded', function() {
    // Format dates if needed
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    
    if (startDate.value) {
        startDate.value = startDate.value.slice(0, 16); // Remove seconds
    }
    if (endDate.value) {
        endDate.value = endDate.value.slice(0, 16); // Remove seconds
    }
});
</script>
@endsection