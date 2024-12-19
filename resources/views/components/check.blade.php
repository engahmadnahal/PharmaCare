@props([
    'id' => null,
    'checked' => false,
    'name' => ''
])

<label class="form-check form-switch form-check-custom form-check-solid">
    <input class="form-check-input" id="{{$id}}" type="checkbox" @checked($checked)>
    <span class="form-check-label fw-semibold text-muted">{{$name}}</span>
</label>