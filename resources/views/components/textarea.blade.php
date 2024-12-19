@props([
    'name' => '-',
    'id' => 'none',
    'value' => null,
    'dir' => 'rtl',
    'disabled' => false

])
<div class="form-group row mt-4">
    <label class="col-3 col-form-label">{{$name}}:</label>
    <div class="col-lg-9 col-md-9 col-sm-12">
       
        <textarea class="form-control" id="{{$id}}" placeholder="{{ $name }}" 
        
        {{$disabled ? 'disabled' : ''}}
        dir="{{$dir}}" >{{$value}}</textarea>
        <span class="form-text text-muted">{{ __('cms.please_enter') }} {{ $name }}</span>
    </div>
</div>
