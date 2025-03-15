@extends('cms.parent')

@section('page-name',__('cms.edit_category'))
@section('main-page',__('cms.categories'))
@section('sub-page',__('cms.edit'))

@section('styles')
<!-- No additional styles needed for this simple form -->
@endsection

@section('content')
<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">{{__('cms.edit_category')}}</h3>
    </div>

    <form id="edit-form">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.name_ar')}}:</label>
                        <input type="text" class="form-control" id="name_ar" 
                            value="{{$category->name_ar}}"
                            placeholder="{{__('cms.enter_name_ar')}}"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{__('cms.name_en')}}:</label>
                        <input type="text" class="form-control" id="name_en" 
                            value="{{$category->name_en}}"
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
                                <input type="radio" name="status" id="status_active" 
                                    value="1" {{$category->status ? 'checked' : ''}}/>
                                <span></span>
                                {{__('cms.active')}}
                            </label>
                            <label class="radio">
                                <input type="radio" name="status" id="status_inactive" 
                                    value="0" {{!$category->status ? 'checked' : ''}}/>
                                <span></span>
                                {{__('cms.inactive')}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="button" onclick="performUpdate()" class="btn btn-primary mr-2">{{__('cms.save')}}</button>
            <a href="{{route('categories.index')}}" class="btn btn-secondary">{{__('cms.cancel')}}</a>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script>
function performUpdate() {
    axios.put('/cms/admin/categories/{{$category->id}}', {
        name_ar: document.getElementById('name_ar').value,
        name_en: document.getElementById('name_en').value,
        status: document.querySelector('input[name="status"]:checked').value
    })
    .then(function (response) {
        toastr.success(response.data.message);
        window.location.href = '/cms/admin/categories';
    })
    .catch(function (error) {
        let errors = error.response.data.errors;
        for (let key in errors) {
            toastr.error(errors[key][0]);
        }
    });
}
</script>
@endsection