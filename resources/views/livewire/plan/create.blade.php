<x-form-component.form-component
    :method="'post'"
    :route="'plan.store'"
    :element-id="'plan-create'"
>

    {{--    Tag --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="tag"
                 label="Tag*"
                 placeholder="Tag f.e free, standart, basic"
                 icon="pencil"
                 hint="Tag is identifier of plan it is required to write it in english"
        />
    </div>
    {{--    Tag--}}
    {{--    Name --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="code"
                 label="Code (kk,ru,en etc.)*"
                 placeholder="Code"
                 icon="globe"
                 hint="Code of language"
        />
    </div>
    {{--    Name--}}
    {{-- Is Active --}}
    <x-checkbox
        id="is_active"
        label="Активный"
        icon="check"
        wire:model.defer="isActive"
    />
    {{-- Is Active --}}



</x-form-component.form-component>
