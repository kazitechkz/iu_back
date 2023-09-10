<x-form-component.form-component
    :method="'post'"
    :route="'page.store'"
    :element-id="'page-create'"
>
    {{--    Locales --}}
    <div class="form-group">
        <x-select
            label="{{__('table.locale_id')}}*"
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
                 label="{{__('table.title')}}*"
                 placeholder="{{__('table.title')}}"
                 icon="pencil"
                 hint="{{__('table.title')}}"
        />
    </div>
    {{--    Name--}}
    {{--    Code --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="code"
                 label="{{__('table.code')}}*"
                 placeholder="{{__('table.code')}}"
                 icon="globe"
                 hint="{{__('table.code')}}"
        />
    </div>
    {{--    Code--}}

    {{--    Content --}}
    <div class="form-group">
        <x-textarea
            wire:model="content"
            label="{{__('table.content')}}*"
            placeholder="{{__('table.content')}}"
            hint="{{__('table.content')}}"
        />
    </div>
    {{--    Content --}}

    {{--    Locale --}}

    {{--    Locale --}}

    {{-- Is Active --}}
    <x-checkbox
        id="isActive"
        label="{{__('table.is_active')}}"
        icon="check"
        wire:model.defer="isActive"
    />
    {{-- Is Active --}}
</x-form-component.form-component>
