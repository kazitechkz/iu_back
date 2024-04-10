<x-form-component.form-component
    :method="'post'"
    :route="'information-author.store'"
    :element-id="'information-author-create'"
>
    {{--    User Name--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="name"
                 label="{{__('table.user_name')}}*"
                 placeholder="{{__('table.user_name_hint')}}"
                 icon="user"
                 hint="{{__('table.user_name')}}"
        />
    </div>
    {{--    User Name--}}
    {{-- Image Url --}}
    <label class="h-5">{{__('table.image_url')}}*</label>
    <livewire:image-upload :folder-name="'information_author'"/>
    {{-- Image Url --}}
</x-form-component.form-component>
