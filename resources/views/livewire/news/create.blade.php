<x-form-component.form-component
    :method="'post'"
    :route="'news.store'"
    :element-id="'news-create'"
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
    {{--    Title --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title"
                 label="Title*"
                 placeholder="Title for News"
                 icon="pencil"
                 hint="Title for News"
        />
    </div>
    {{--    Title--}}
    {{--    Subtitle --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="subtitle"
                 label="Subtitle*"
                 placeholder="Subtitle for News"
                 icon="pencil"
                 hint="Subtitle"
        />
    </div>
    {{--    Subtitle--}}
    {{--    Description--}}
    <div class="form-group">
        <x-textarea
            wire:model="description"
            label="Description*"
            placeholder="Description"
            hint="Description of plan"
        />
    </div>
    {{--    Description --}}

    {{-- Poster --}}
        <label class="h-5">Poster*</label>
        <livewire:image-upload :output_name="'poster'" :folder-name="'news'"/>
    {{-- Poster --}}

    {{-- Image Url --}}
        <label class="h-5">Image Url*</label>
        <livewire:image-upload :folder-name="'news'"/>
    {{-- Image Url --}}

    {{-- Is Active --}}
    <div class="form-group">
        <x-checkbox
            id="is_active"
            label="Is Active"
            icon="check"
            wire:model.defer="is_active"
        />
    </div>
    {{-- Is Active --}}
    {{-- Is Important --}}
    <div class="form-group">
        <x-checkbox
            id="is_important"
            label="Showed at Main Screen"
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

