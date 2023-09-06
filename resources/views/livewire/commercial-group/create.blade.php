<x-form-component.form-component
    :method="'post'"
    :route="'commercial-group.store'"
    :element-id="'commercial-group-create'"
>

    {{--    Title in Russian --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_ru"
                 label="Title in Russian*"
                 placeholder="Title in Russian"
                 icon="pencil"
                 hint="Title in Russian"
        />
    </div>
    {{--    Title in Russian --}}
    {{--    Title in Kazakh --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_kk"
                 label="Title in Kazakh*"
                 placeholder="Title in Kazakh"
                 icon="pencil"
                 hint="Title in Kazakh"
        />
    </div>
    {{--    Title in Kazakh --}}
    {{--    Title in English --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_en"
                 label="Title in English"
                 placeholder="Title in English"
                 icon="pencil"
                 hint="Title in English"
        />
    </div>
    {{--    Title in English --}}
    {{--    Tag --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="tag"
                 label="Tag"
                 placeholder="Tag"
                 icon="pencil"
                 hint="Tag must be unique"
        />
    </div>
    {{--    Tag --}}
    {{-- Is Active --}}
    <x-checkbox
        id="is_active"
        label="Активный*"
        icon="check"
        wire:model.defer="is_active"
    />
    {{-- Is Active --}}


</x-form-component.form-component>
