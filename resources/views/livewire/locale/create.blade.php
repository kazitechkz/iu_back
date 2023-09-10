<x-form-component.form-component
    :method="'post'"
    :route="'locale.store'"
    :element-id="'locale-create'"
>

    {{--    Title --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title"
                 label="{{__('table.title')}}*"
                 placeholder="{{__('table.title')}}"
                 icon="pencil"
                 hint="{{__('table.title')}}"
        />
    </div>
    {{--    Title--}}
    {{--    Code --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="code"
                 label="{{__('table.code')}} (kk,ru,en etc.)*"
                 placeholder="{{__('table.code')}}"
                 icon="globe"
                 hint="{{__('table.code')}} ISO 639-1"
        />
    </div>
    {{--    Code--}}
    {{-- Is Active --}}
    <x-checkbox
        id="is_active"
         label="{{__('table.is_active')}}"
         icon="check"
         wire:model.defer="isActive"
    />
    {{-- Is Active --}}



</x-form-component.form-component>
