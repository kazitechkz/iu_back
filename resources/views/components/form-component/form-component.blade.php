<form
    method="{{$method != "get" ? "post" : "get"}}"
    action="{{route($route,$parameters)}}"
    enctype="{{$enctype}}"
    id="{{$elementId}}"
>
    @csrf
    @method(strtoupper($method))
    {{--    Error Block--}}
    <div class="form-group">
        <x-errors />
    </div>
    {{--    Error Block--}}
    {{ $slot }}
    <div class="col-md-12 text-right my-2">
        @if($isSend)
            <x-button type="submit" label="Send" primary md icon="check" />
         @endif
         @if($isClear)
            <x-button type="reset" label="Clear all" class="bg-red-500 text-white" md icon="ban" />
         @endif
    </div>
</form>
