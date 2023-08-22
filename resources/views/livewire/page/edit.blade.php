<x-form-component.form-component
    :method="'put'"
    :route="'page.update'"
    :parameters="['page'=>$page]"
    :element-id="'page-create'"
>
    {{--    Locales --}}
    <div class="form-group">
        <x-select
            label="Locale*"
            :options="$locales"
            option-label="title"
            option-value="id"
            wire:model="locale_id"
            name="locale_id"
        />
    </div>
    {{--    Locales--}}
    {{--    Name --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title"
                 label="Title*"
                 placeholder="Title of page"
                 icon="pencil"
                 hint="Title"
        />
    </div>
    {{--    Name--}}
    {{--    Code --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="code"
                 label="Code (about_us,privacy_policy,etc)*"
                 placeholder="Code"
                 icon="globe"
                 hint="Code of page"
        />
    </div>
    {{--    Code--}}

    {{--    Content --}}
    <div class="form-group">
        <x-textarea
            wire:model.defer="content"
            label="Content*"
            placeholder="Content"
            hint="Content of page"
        />
    </div>
    {{--    Content --}}

    {{--    Locale --}}

    {{--    Locale --}}

    {{-- Is Active --}}
    <x-checkbox
        id="isActive"
        label="Активный"
        icon="check"
        wire:model.defer="isActive"
    />
    {{-- Is Active --}}
</x-form-component.form-component>
