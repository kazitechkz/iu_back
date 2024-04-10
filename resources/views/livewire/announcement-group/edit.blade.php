<x-form-component.form-component
    :method="'put'"
    :route="'announcement-group.update'"
    :parameters="['announcement_group'=>$announcementGroup]"
    :element-id="'announcement-group-update'"
>
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
    {{--    Title Ru --}}
    {{--    Title KK --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_kk"
                 label="{{__('table.title_kk')}}*"
                 placeholder="{{__('table.title_kk')}}"
                 icon="pencil"
                 hint="{{__('table.title_kk')}}"
        />
    </div>
    {{--    Title Kk --}}
    {{--    Title En --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_en"
                 label="{{__('table.title_en')}}*"
                 placeholder="{{__('table.title_en')}}"
                 icon="pencil"
                 hint="{{__('table.title_en')}}"
        />
    </div>
    {{--    Title En --}}
    {{-- Image Url --}}
    <label class="h-5">{{__('table.image_url')}}*</label>
    <livewire:image-upload :output_name="'thumbnail'" :folder-name="'announcement-group'" :id="$thumbnail != null ? $thumbnail : 0"/>
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
    {{-- Order --}}
    <div class="form-group">
        <x-inputs.number
            label="Order*"
            min="0"
            wire:model="order"
            hint="Level - higher - more inportant"
        />
    </div>
    {{-- Order --}}
    {{-- Start At --}}
    <div class="form-group">
        <x-datepicker
            label="{{__('table.start_at')}} *" wire:model="start_date"
            :config="['altFormat' => 'd-m-Y H:i','enableTime'=>true,'time_24hr'=>true]"
            name="start_date"
            class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm pl-8 my-2" />
    </div>
    {{--Start At --}}


    {{-- End At --}}
    <div class="form-group">
        <x-datepicker
            label="{{__('table.end_at')}} *" wire:model="end_date"
            :config="['altFormat' => 'd-m-Y H:i','enableTime'=>true,'time_24hr'=>true]"
            name="end_date"
            class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm pl-8 my-2" />
    </div>
    {{--End At --}}
</x-form-component.form-component>
