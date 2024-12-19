@props([
    'name' => '-',
    'type' => 'text',
    'id' => 'none',
    'value' => null,
    'col' => 3,
    'dir' => 'rtl',
    'disabled' => false

])
<div class="form-group row mt-4">
    <label class="col-{{$col}} col-form-label">{{$name}}:</label>
    <div class="col-lg-4 col-md-9 col-sm-12">
        <input 
        type="{{$type}}" 
        class="form-control" 
        id="{{$id}}" 
        placeholder="{{ $name }}" 
        dir="{{$dir}}" 
        value="{{$value}}" 
        {{$disabled ? 'disabled' : ''}}
        />
        <span class="form-text text-muted">{{ __('cms.please_enter') }} {{ $name }}</span>
    </div>
</div>
