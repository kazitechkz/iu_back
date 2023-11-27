<x-form-component.form-component
    :method="'put'"
    :route="'announcement.update'"
    :parameters="['announcement'=>$announcement]"
    :element-id="'announcement-update'"
>
    {{--    Type --}}
    <div class="form-group">
        <x-select
            label="{{__('table.type_id')}}*"
            :options="$types"
            option-label="title_ru"
            option-value="id"
            wire:model="type_id"
            name="type_id"
        />
    </div>
    {{--    Type--}}
    {{--    Group --}}
    <div class="form-group">
        <x-select
            label="{{__('table.group_id')}}*"
            :options="$groups"
            option-label="title_ru"
            option-value="id"
            wire:model="group_id"
            name="group_id"
        />
    </div>
    {{--    Group--}}
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
    {{--    Title --}}
    {{--    Sub Title --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="sub_title"
                 label="{{__('table.sub_title')}}*"
                 placeholder="{{__('table.sub_title')}}"
                 icon="pencil"
                 hint="{{__('table.sub_title')}}"
        />
    </div>
    {{--    Sub Title --}}

    {{--    Description--}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description" :input-name="'description'" :title="'Описание'"/>
            </div>
        </div>
    </div>
    {{--    Description --}}
    {{--    URL TEXT --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="url_text"
                 label="{{__('table.url_text')}}"
                 placeholder="{{__('table.url_text')}}"
                 icon="pencil"
                 hint="{{__('table.url_text')}}"
        />
    </div>
    {{--     URL TEXT --}}
    {{--    URL --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="url"
                 label="{{__('table.url')}}"
                 placeholder="{{__('table.url')}}"
        icon="pencil"
        hint="{{__('table.url')}}"
        />
    </div>
    {{--     URL  --}}
    {{-- Image Url --}}
    <label class="h-5">{{__('table.image_url')}}*</label>
    <livewire:image-upload :output_name="'background'" :folder-name="'announcement'" :id="$background != null ? $background : 0"/>
    {{-- Image Url --}}
    {{-- Timer --}}
    <div class="form-group">
        <x-inputs.number
            label="Time in sec*"
            min="5"
            max="60"
            wire:model="time_in_sec"
            hint="Timer in seconds"
        />
    </div>
    {{-- Timer --}}
</x-form-component.form-component>
