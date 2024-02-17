<x-form-component.form-component
    :method="'post'"
    :route="'iutube-author.store'"
    :element-id="'iutube-author-create'"
>
    {{-- Image Url --}}
    <label class="h-5">{{__('table.image_url')}}*</label>
    <livewire:image-upload :folder-name="'iutube-author'"/>
    {{-- Image Url --}}
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
    {{--    Description --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description" :input-name="'description'" :title="'Об Авторе'"/>
            </div>
        </div>
    </div>
    {{--    Description --}}
    {{--    Instagram--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="instagram_url"
                 label="Профиль в Instagram"
                 placeholder="Instagram"
                 icon="information-circle"
        />
    </div>
    {{--    Instagram--}}
    {{--    Facebook--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="facebook_url"
                 label="Профиль в Facebook"
                 placeholder="Facebook"
                 icon="information-circle"
        />
    </div>
    {{--    Facebook--}}
    {{--    VK--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="vk_url"
                 label="Профиль в VK"
                 placeholder="VK"
                 icon="information-circle"
        />
    </div>
    {{--    VK--}}
    {{--    LinkedIn--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="linkedin_url"
                 label="Профиль в LinkedIn"
                 placeholder="LinkedIn"
                 icon="information-circle"
        />
    </div>
    {{--    LinkedIn--}}
    {{--    Site--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="tiktok_url"
                 label="Tiktok"
                 placeholder="{{__("table.tiktok_url")}}"
                 icon="information-circle"
        />
    </div>
    {{--    Site--}}
    {{--     Phone--}}
    <div class="form-group">
        <x-inputs.phone
            label="{{__('table.phone')}}"
            placeholder="{{__('table.phone_placeholder')}}"
            hint="{{__('table.phone_hint')}}"
            wire:model.lazy="phone"
            icon="phone"
            mask="['+###########']"
        />
    </div>
    {{--     Phone--}}
    {{--     Email--}}
    <div class="form-group">
        <x-input
            type="email"
            class="my-2"
            wire:model="email"
            label="{{__('table.email')}}*"
            placeholder="{{__('table.email_placeholder')}}"
            icon="mail"
            hint="{{__('table.email_hint')}}"
        />
    </div>
    {{--     Email--}}
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
</x-form-component.form-component>

