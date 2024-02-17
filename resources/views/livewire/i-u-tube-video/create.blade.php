<x-form-component.form-component
    :method="'post'"
    :route="'iutube-video.store'"
    :element-id="'iutube-video-create'"
>

    {{--    Subjects  --}}
    <div class="form-group">
        <x-select
            :label="__('table.subject')"
            :options="$subjects"
            :option-value="'id'"
            :option-label="'title_ru'"
            wire:model="subject_id"
        />
    </div>
    {{--    Subjects--}}
    {{--    Steps  --}}
    <div class="form-group">
        <x-select
            :label="'Этапы'"
            :options="$steps"
            :option-value="'id'"
            :option-label="'title_ru'"
            wire:model="step_id"
        />
    </div>
    {{--    Steps--}}
    {{--    SubSteps  --}}
    <div class="form-group">
        <x-select
            :label="'СубЭтапы'"
            :options="$sub_steps"
            :option-value="'id'"
            :option-label="'title_ru'"
            wire:model="sub_step_id"
        />
    </div>
    {{--    SubSteps--}}
    {{--    Authors  --}}
    <div class="form-group">
        <x-select
            :label="'Автор'"
            :options="$authors"
            :option-value="'id'"
            :option-label="'name'"
            wire:model="author_id"
        />
    </div>
    {{--    Authors--}}
    {{--    Locales  --}}
    <div class="form-group">
        <x-select
            :label="'Локали'"
            :options="$locales"
            :option-value="'id'"
            :option-label="'title'"
            wire:model="locale_id"
        />
    </div>
    {{--    Locales--}}
    {{-- Image Url --}}
    <label class="h-5">{{__('table.image_url')}}</label>
    <livewire:image-upload :folder-name="'iutube-video'"/>
    {{-- Image Url --}}
    {{--    Title--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title"
                 label="{{__('table.title')}}*"
                 placeholder="{{__('table.title')}}"
                 icon="pencil"
                 hint="{{__('table.title')}}"
        />
    </div>
    {{--    Title --}}
    {{--    Description --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description" :input-name="'description'" :title="'Об Авторе'"/>
            </div>
        </div>
    </div>
    {{--    Description --}}
    {{-- Price --}}
    <div class="form-group">
        <x-inputs.number
            label="{{__('table.price')}}*"
            prefix="KZT"
            wire:model="price"
            hint="{{__('table.price')}}"
        />
    </div>
    {{-- Price --}}
    {{--    Youtube--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="video_url"
                 label="Ссылка Youtube*"
                 placeholder="Youtube"
                 icon="information-circle"
        />
    </div>
    {{--    Youtube--}}
    {{-- Is Recomended --}}
    <div class="form-group">
        <x-checkbox
            id="is_recommended"
            label="Рекомендуемые"
            icon="check"
            wire:model.defer="is_recommended"
        />
    </div>
    {{-- Is Recomended --}}
    {{-- Is Public --}}
    <div class="form-group">
        <x-checkbox
            id="is_public"
            label="Общее доступное видео"
            icon="check"
            wire:model.defer="is_public"
        />
    </div>
    {{-- Is Public --}}
</x-form-component.form-component>

