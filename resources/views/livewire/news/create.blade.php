<x-form-component.form-component
    :method="'post'"
    :route="'news.store'"
    :element-id="'news-create'"
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
    {{--    Subtitle --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="subtitle"
                 label="{{__('table.sub_title')}}*"
                 placeholder="{{__('table.sub_title')}}"
                 icon="pencil"
                 hint="{{__('table.sub_title')}}"
        />
    </div>
    {{--    Subtitle--}}
    {{--    Description--}}
    <div class="form-group">
        <x-textarea
            wire:model="description"
            label="{{__('table.description')}}*"
            placeholder="{{__('table.description')}}"
            hint="{{__('table.description')}}"
        />
    </div>
    {{--    Description --}}

    {{-- Poster --}}
        <label class="h-5">{{__('table.poster')}}*</label>
        <livewire:image-upload :output_name="'poster'" :folder-name="'news'"/>
    {{-- Poster --}}

    {{-- Image Url --}}
        <label class="h-5">{{__('table.image_url')}}*</label>
        <livewire:image-upload :folder-name="'news'"/>
    {{-- Image Url --}}

    {{-- Is Active --}}
    <div class="form-group">
        <x-checkbox
            id="is_active"
            label="{{__('table.is_active')}}"
            icon="check"
            wire:model.defer="is_active"
        />
    </div>
    {{-- Is Active --}}
    {{-- Is Important --}}
    <div class="form-group">
        <x-checkbox
            id="is_important"
            label="{{__('table.is_important')}}"
            icon="check"
            wire:model.defer="is_important"
        />
    </div>
    {{-- Is Important --}}
    {{-- Published At* --}}
    <x-datetime-picker
        label="Published Date"
        time-format="24"
        parse-format="DD-MM-YYYY HH:mm"
        :min="now()"
        :max="now()->addYear(2)"
        wire:model="published_at"
        hint="Published Date"
    />
    {{--Published At --}}
</x-form-component.form-component>

