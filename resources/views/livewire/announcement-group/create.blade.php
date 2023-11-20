<x-form-component.form-component
    :method="'post'"
    :route="'announcement-group.store'"
    :element-id="'announcement-group-create'"
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
    <x-datetime-picker
        label="{{__('table.start_at')}} *"
        time-format="24"
        parse-format="DD-MM-YYYY HH:mm"
        :min="now()"
        :max="now()->addYear(2)"
        wire:model="start_date"
        hint="{{__('table.start_at')}}"
    />
    {{--Start At --}}
    {{-- End At --}}
    <x-datetime-picker
        label="{{__('table.end_at')}} *"
        time-format="24"
        parse-format="DD-MM-YYYY HH:mm"
        :min="now()"
        :max="now()->addYear(2)"
        wire:model="end_date"
        hint="{{__('table.end_at')}}"
    />
    {{--End At --}}
</x-form-component.form-component>
