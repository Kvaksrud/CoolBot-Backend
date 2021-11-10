<div {{ $attributes }}>
    <div class="form-check form-switch @error($name) border-danger @enderror ">
        <input @if($checked) checked @endif @if(is_array(old(str_replace('[]','',$name))) && in_array($value, old(str_replace('[]','',$name)))) checked @endif value="{{$value}}" class="form-check-input" type="checkbox" id="{{ $name }}" name="{{ $name }}" @if($disabled === "true") disabled @endif>
        <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>
    </div>
    @error($name)
    <span class="text-danger small">{{ $message }}</span>
    @enderror
</div>
