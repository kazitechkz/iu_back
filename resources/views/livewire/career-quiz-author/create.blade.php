<x-form-component.form-component
    :method="'post'"
    :route="'career-quiz-author.store'"
    :element-id="'career-quiz-author-create'"
>
    {{--    Group  --}}
    <div class="form-group">
        <x-select

            :label="__('table.group_id')"
            :options="$groups"
            :option-value="'id'"
            :option-label="'title_ru'"

            wire:model.defer="group_id"

        />
    </div>
    {{--    Group--}}
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
    <livewire:image-upload :folder-name="'career_author'"/>
    {{-- Image Url --}}
    {{--    Position Ru --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="position_ru"
                 label="{{__('table.position_ru')}}*"
                 placeholder="{{__('table.position_ru')}}"
                 icon="pencil"
                 hint="{{__('table.position_ru')}}"
        />
    </div>
    {{--    Position Ru --}}
    {{--    Position Kk --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="position_kk"
                 label="{{__('table.position_kk')}}*"
                 placeholder="{{__('table.position_kk')}}"
                 icon="pencil"
                 hint="{{__('table.position_kk')}}"
        />
    </div>
    {{--    Position Kk --}}
    {{--    Description Ru --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description_ru" :input-name="'description_ru'" :title="'Об Авторе (Ru)*'"/>
            </div>
        </div>
    </div>
    {{--    Description Ru --}}
    {{--    Description Kk --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description_kk" :input-name="'description_kk'" :title="'Об Авторе (Kk)*'"/>
            </div>
        </div>
    </div>
    {{--    Description Kk --}}
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
                 wire:model="site"
                 label="Сайт"
                 placeholder="{{__("table.site")}}"
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

</x-form-component.form-component>
