<div {{ $attributes }}>
    <div class="form-floating">
        <input type="{{ $type }}" class="form-control @error($name) border-danger @enderror " id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{old($name) ?? $value}}" @if($required) required @endif @if($disabled === "true") disabled @endif>
        <label for="{{ $name }}">{{ $label }}</label>
    </div>
    @error($name)
    <span class="text-danger small">{{ $message }}</span>
    @enderror
</div>
