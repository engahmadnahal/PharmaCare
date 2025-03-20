@extends('cms.parent')

@section('page-name',__('cms.create_coupon'))
@section('main-page',__('cms.coupons'))
@section('sub-page',__('cms.create'))

@section('styles')
<link href="{{asset('cms/css/datetimepicker.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">{{__('cms.create_coupon')}}</h3>
    </div>

    <form id="create-form">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.code')}}:</label>
                        <input type="text" class="form-control" id="code" 
                            placeholder="{{__('cms.enter_coupon_code')}}"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.discount')}}:</label>
                        <input type="number" class="form-control" id="discount" 
                            placeholder="{{__('cms.enter_discount')}}" min="0" step="0.01"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.max_uses')}}:</label>
                        <input type="number" class="form-control" id="max_uses" 
                            placeholder="{{__('cms.enter_max_uses')}}" min="1"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.status')}}:</label>
                        <div class="radio-inline">
                            <label class="radio">
                                <input type="radio" name="is_active" value="1" checked/>
                                <span></span>
                                {{__('cms.active')}}
                            </label>
                            <label class="radio">
                                <input type="radio" name="is_active" value="0"/>
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
                        <input type="date" class="form-control" id="start_date"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.end_date')}}:</label>
                        <input type="date" class="form-control" id="end_date"/>
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
    axios.post('/cms/employee/coupons', {
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
            toastr.error('An error occurred while saving the coupon');
        }
    });
}
</script>
@endsection