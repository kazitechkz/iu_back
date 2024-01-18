<x-form-component.form-component
    :method="'post'"
    :route="'career-quiz-group.store'"
    :element-id="'career-quiz-group-create'"
>
    {{--    Title in Russian --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_ru"
                 label="{{__('table.title_ru')}}*"
                 placeholder="{{__('table.title_ru')}}"
                 icon="pencil"
                 hint="{{__('table.title_ru')}}"
        />
    </div>
    {{--    Title in Russian --}}
    {{--    Title in Kazakh --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_kk"
                 label="{{__('table.title_kk')}}*"
                 placeholder="{{__('table.title_kk')}}"
                 icon="pencil"
                 hint="{{__('table.title_kk')}}"
        />
    </div>
    {{--    Title in Kazakh --}}
    {{--    Title in English --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_en"
                 label="{{__('table.title_en')}}"
                 placeholder="{{__('table.title_en')}}"
                 icon="pencil"
                 hint="{{__('table.title_en')}}"
        />
    </div>
    {{--    Title in English --}}
    {{--    Description Ru --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description_ru" :input-name="'description_ru'" :title="'Описание Компании (Ru)*'"/>
            </div>
        </div>
    </div>
    {{--    Description Ru --}}
    {{--    Description Kk --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description_kk" :input-name="'description_kk'" :title="'Описание Компании (Kk)*'"/>
            </div>
        </div>
    </div>
    {{--    Description Kk --}}
    {{--    Description En --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description_en" :input-name="'description_en'" :title="'Описание Компании (En)'"/>
            </div>
        </div>
    </div>
    {{--    Description En --}}
    {{--    Address--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="address"
                 label="{{__('table.address')}}"
                 placeholder="{{__('table.address')}}"
                 icon="map"
                 hint="{{__('table.address')}}"
        />
    </div>
    {{--    Address--}}
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
    {{-- currency--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="currency"
                 label="{{__('table.currency')}}*"
                 placeholder="KZT USD EUR "
                 icon="pencil"
                 hint="{{__('table.currency_hint')}}"
        />
    </div>
    {{-- currency --}}
</x-form-component.form-component>
