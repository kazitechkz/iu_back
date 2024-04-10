<x-form-component.form-component
    :method="'post'"
    :route="'information.store'"
    :element-id="'information-create'"
>

    {{--    Author  --}}
    <div class="form-group">
        <x-select
            :label="__('table.author_id')"
            :options="$authors"
            :option-value="'id'"
            :option-label="'name'"
            wire:model="author_id"
        />
    </div>
    {{--    Author--}}
    {{--    Categories  --}}
    <div class="form-group">
        <x-select
            :label="__('table.category_id')"
            :options="$categories"
            :option-value="'id'"
            :option-label="'title_ru'"
            wire:model="category_id"
        />
    </div>
    {{--    Categories--}}

    {{--    Seo Title --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="seo_title"
                 label="Seo Title*"
                 icon="pencil"
        />
    </div>
    {{--    Seo Title--}}
    {{--    Seo Description --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="seo_description"
                 label="Seo Description*"
                 icon="pencil"
        />
    </div>
    {{--    Seo Description--}}
    {{--    Seo Keywords --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="seo_keywords"
                 label="Seo Keywords*"
                 icon="pencil"
        />
    </div>
    {{--    Seo Keywords--}}
    {{-- Image Url --}}
    <label class="h-5">{{__('table.image_url')}}*</label>
    <livewire:image-upload :folder-name="'information'"/>
    {{-- Image Url --}}
    {{--    Title Ru --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_ru"
                 label="{{__('table.title_ru')}}*"
                 placeholder="{{__('table.title_ru')}}"
                 icon="pencil"
                 hint="{{__('table.title_ru')}}"
        />
    </div>
    {{--    Title Ru--}}
    {{--    Title Kk --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_kk"
                 label="{{__('table.title_kk')}}*"
                 placeholder="{{__('table.title_kk')}}"
                 icon="pencil"
                 hint="{{__('table.title_kk')}}"
        />
    </div>
    {{--    Title Kk--}}
    {{--    Description Ru --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description_ru" :input-name="'description_ru'" :title="'Описание (Ru)*'"/>
            </div>
        </div>
    </div>
    {{--    Description Ru --}}
    {{--    Description Kk --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description_kk" :input-name="'description_kk'" :title="'Описание (Kk)*'"/>
            </div>
        </div>
    </div>
    {{--    Description Kk --}}
    {{-- Published At --}}
    <div class="form-group">
        <x-datepicker
            label="{{__('table.published_at')}} *" wire:model="published_at"
            :config="['altFormat' => 'd-m-Y H:i','enableTime'=>true,'time_24hr'=>true]"
            name="published_at"
            class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm pl-8 my-2" />
    </div>
    {{--Published At --}}
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
    {{-- Is Main --}}
    <div class="form-group">
        <x-checkbox
            id="is_main"
            label="Главная новость"
            icon="check"
            wire:model.defer="is_main"
        />
    </div>
    {{-- Is Main --}}
</x-form-component.form-component>

