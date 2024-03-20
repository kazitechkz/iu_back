<x-form-component.form-component
    :method="'post'"
    :route="'career-quiz.store'"
    :element-id="'career-quiz-create'"
>
    {{--    Group  --}}
    <div class="form-group">
        <x-select
            :label="__('table.group_id')"
            :options="$groups"
            :option-value="'id'"
            :option-label="'title_ru'"
            wire:model="group_id"
        />
    </div>
    {{--    Group--}}
    {{--    Career Codes  --}}
    <div class="form-group">
        <x-select
            :label="__('table.code')"
            :options="$codes"
            :option-value="'id'"
            :option-label="'title_ru'"
            wire:model="code"
        />
    </div>
    {{--    Career Codes --}}
    {{--    Authors  --}}
    <div class="form-group">
        <x-select
            name="authors"
            :label="__('table.authors')"
            multiselect
            :options="$quiz_authors"
            :option-value="'id'"
            :option-label="'name'"
            wire:model="authors"
        />
    </div>
    {{--    Authors--}}
    {{-- Image Url --}}
    <label class="h-5">{{__('table.image_url')}}*</label>
    <livewire:image-upload :folder-name="'career_quiz'"/>
    {{-- Image Url --}}
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
    {{--    Description En --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description_en" :input-name="'description_en'" :title="'Описание (En)'"/>
            </div>
        </div>
    </div>
    {{--    Description En --}}
    {{--    Rule Ru --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$rule_ru" :input-name="'rule_ru'" :title="'Правила (Ru)*'"/>
            </div>
        </div>
    </div>
    {{--    Rule Ru --}}
    {{--    Rule Kk --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$rule_kk" :input-name="'rule_kk'" :title="'Правила (Kk)*'"/>
            </div>
        </div>
    </div>
    {{--    Rule Kk --}}
    {{--    Rule En --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$rule_en" :input-name="'rule_en'" :title="'Правила (En)'"/>
            </div>
        </div>
    </div>
    {{--    Rule En --}}
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
    {{-- Old Price --}}
    <div class="form-group">
        <x-inputs.number
            label="Старая цена"
            prefix="KZT"
            wire:model="old_price"
            hint="Старая цена (реклама)"
        />
    </div>
    {{--Old Price --}}
    {{-- Order --}}
    <div class="form-group">
        <x-inputs.number
            label="Порядок"
            wire:model="order"
            hint="Порядок ( 1, 2 , 3 и тд"
        />
    </div>
    {{-- Order --}}
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
