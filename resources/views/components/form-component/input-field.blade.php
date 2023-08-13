<div class="form-group">
    <label for="{{$elementId}}">
        {{$label}}
        @if($required)
            *
        @endif
    </label>
    <input
        name="{{$name}}"
        type="{{$type}}"
        class="form-control @error($name) border-danger @enderror"
        id="{{$elementId}}"
        placeholder="{{$placeholder}}"
        value="{{$value}}"
    >
</div>
<x-error-component.validation-error name="{{$name}}"></x-error-component.validation-error>
