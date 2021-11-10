<div {{ $attributes }}>
    <div class="form-floating">
        <textarea @if($disabled === "true") disabled @endif class="form-control @error($name) border-danger @enderror " style="height: {{ $height }}" placeholder="{{ $placeholder }}" id="{{ $name }}" name="{{ $name }}" size="{{ $size ?? 20 }}" @if($required) required @endif >{{old($name) ?? $value ?? ''}}</textarea>
        <label for="{{ $name }}">{{ $label }}</label>
    </div>
    @error($name)
    <span class="text-danger small">{{ $message }}</span>
    @enderror
</div>
