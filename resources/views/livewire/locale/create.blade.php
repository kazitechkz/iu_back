<x-form-component.form-component
    :method="'post'"
    :route="'locale.store'"
    :element-id="'locale-create'"
>

    {{--    Title --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title"
                 label="Title*"
                 placeholder="Title"
                 icon="pencil"
                 hint="Title"
        />
    </div>
    {{--    Title--}}
    {{--    Code --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="code"
                 label="Code (kk,ru,en etc.)*"
                 placeholder="Code"
                 icon="globe"
                 hint="Code of language"
        />
    </div>
    {{--    Code--}}
    {{-- Is Active --}}
    <x-checkbox
        id="is_active"
         label="Активный"
         icon="check"
         wire:model.defer="isActive"
    />
    {{-- Is Active --}}



</x-form-component.form-component>
