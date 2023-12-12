<x-form-component.form-component
    :method="'post'"
    :route="'tournament.store'"
    :element-id="'tournament-create'"
>
    {{--    Subject  --}}
    <div class="form-group">
        <x-select
            label="{{__('table.subject_id')}}*"
            :options="$subjects"
            option-label="title_ru"
            option-value="id"
            wire:model="subject_id"
            name="subject_id"
        />
    </div>
    {{--    Subject--}}
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
    {{--    Title En --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_en"
                 label="{{__('table.title_en')}}"
                 placeholder="{{__('table.title_en')}}"
                 icon="pencil"
                 hint="{{__('table.title_en')}}"
        />
    </div>
    {{--    Title En--}}
    {{--    Rule Ru --}}
    <div class="form-group">
    <div class="md:flex lg:flex justify-between my-3">
        <div wire:ignore class="w-full">
            <x-ckeditor :description="$rule_ru" :input-name="'rule_ru'" :title="'Правила (RU)'"/>
        </div>
    </div>
    </div>
    {{--    Rule Ru --}}
    {{--    Rule Kk --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$rule_kk" :input-name="'rule_kk'" :title="'Правила (KK)'"/>
            </div>
        </div>
    </div>
    {{--    Rule Kk --}}
    {{--    Rule En --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$rule_en" :input-name="'rule_en'" :title="'Правила (EN)'"/>
            </div>
        </div>
    </div>
    {{--    Rule En --}}

    {{--    Description Ru --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description_ru" :input-name="'description_ru'" :title="'Описание (Ru)'"/>
            </div>
        </div>
    </div>
    {{--    Description Ru --}}
    {{--    Description Kk --}}
    <div class="form-group">
        <div class="md:flex lg:flex justify-between my-3">
            <div wire:ignore class="w-full">
                <x-ckeditor :description="$description_kk" :input-name="'description_kk'" :title="'Описание (Kk)'"/>
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
    {{-- Poster --}}
    <label class="h-5">{{__('table.poster')}}*</label>
    <livewire:image-upload :output_name="'poster'" :folder-name="'tournament'"/>
    {{-- Poster --}}
    {{--    Locale --}}
    <div class="form-group">
        <p class="h-3 mb-3 font-weight-bold">
            {{__('table.locale_id')}}
        </p>
        <div class="form-group">
            @foreach($locales as $locale)
                <x-checkbox
                    value="{{$locale->id}}"
                    id="{{$locale->title}}"
                    name="locale_id[]"
                    multiple="multiple"
                    selected
                    label="{{$locale->title}}"
                />
            @endforeach
        </div>
    </div>
    {{--    Locale --}}
    {{--    Status --}}
    <div class="form-group">
        <x-select
            label="{{__('table.status')}}*"
            :options="[
                ['name'=>'Регистрация завершена','value'=>-1],
                ['name'=>'Ожидание открытия','value'=>0],
                ['name'=>'Открыта регистрация','value'=>1],
            ]"
            option-label="name"
            option-value="value"
            wire:model="status"
            name="status"
        />
    </div>
    {{--    Status --}}
    {{-- Start At --}}
    <div class="form-group">
        <x-datepicker
            label="{{__('table.start_at')}} *" wire:model="start_at"
            :config="['altFormat' => 'd.m.Y, H:i','enableTime'=>true,'time_24hr'=>true]"
            name="start_at"
            class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm pl-8 my-2" />
    </div>
    {{--Start At --}}
    {{-- End At --}}
    <div class="form-group">
        <x-datepicker
            label="{{__('table.end_at')}} *" wire:model="end_at"
            :config="['altFormat' => 'd.m.Y, H:i','enableTime'=>true,'time_24hr'=>true]"
            name="end_at"
            class="placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm pl-8 my-2" />
    </div>
    {{--End At --}}
</x-form-component.form-component>
