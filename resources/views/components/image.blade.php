@props([
    'id' => 'none',
    'value' => null,
    'col' => null
])
<div class="form-group ">
    <label class="col-12 col-form-label">{{ __('cms.image') }}:</label>
    <div class="col-{{$col??9}}">
        <div class="image-input image-input-empty image-input-outline" id="kt_image_{{$id}}"
            style="background-image: url({{ $value ?? asset('assets/media/users/blank.png') }})">
            <div class="image-input-wrapper"></div>

            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                <i class="fa fa-pen icon-sm text-muted"></i>
                <input type="file" name="{{$id}}" id="{{$id}}" accept=".png, .jpg, .jpeg">
                <input type="hidden" name="{{$id}}">
            </label>

            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
                <i class="ki ki-bold-close icon-xs text-muted"></i>
            </span>

            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove avatar">
                <i class="ki ki-bold-close icon-xs text-muted"></i>
            </span>
        </div>
    </div>
</div>
