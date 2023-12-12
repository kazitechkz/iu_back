<x-form-component.form-component
    :method="'put'"
    :route="'news.update'"
    :parameters="['news'=>$news]"
    :element-id="'news-update'"
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
        <x-ckeditor :description="$description" :input-name="'description'" :title="'Описание'"/>
    </div>
    {{--    Description --}}

    {{-- Poster --}}
    <label class="h-5">{{__('table.poster')}}*</label>
    <livewire:image-upload :file="$poster" :id="$news->poster != null ? $news->poster : 0" :output_name="'poster'" :folder-name="'news'"/>
    {{-- Poster --}}

    {{-- Image Url --}}
    <label class="h-5">{{__('table.image_url')}}*</label>
    <livewire:image-upload :file="$image_url" :id="$news->image_url != null ? $news->image_url : 0" :folder-name="'news'"/>
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
    <div class="form-group">
        <x-datepicker
            label="{{__('table.published_at')}}" wire:model="published_at"
            :config="['altFormat' => 'd.m.Y, H:i','enableTime'=>true,'time_24hr'=>true]"
            name="published_at"
            class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm pl-8 my-2" />
    </div>
    {{--Published At --}}
</x-form-component.form-component>

