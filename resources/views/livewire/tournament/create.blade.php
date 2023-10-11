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
        <x-textarea
            wire:model="rule_ru"
            label="{{__('table.rule_ru')}}*"
            placeholder="{{__('table.rule_ru')}}"
            hint="{{__('table.rule_ru')}}"
        />
    </div>
    {{--    Rule Ru --}}
    {{--    Rule Kk --}}
    <div class="form-group">
        <x-textarea
            wire:model="rule_kk"
            label="{{__('table.rule_kk')}}*"
            placeholder="{{__('table.rule_kk')}}"
            hint="{{__('table.rule_kk')}}"
        />
    </div>
    {{--    Rule Kk --}}
    {{--    Rule En --}}
    <div class="form-group">
        <x-textarea
            wire:model="rule_en"
            label="{{__('table.rule_en')}}"
            placeholder="{{__('table.rule_en')}}"
            hint="{{__('table.rule_en')}}"
        />
    </div>
    {{--    Rule En --}}

    {{--    Description Ru --}}
    <div class="form-group">
        <x-textarea
            wire:model="description_ru"
            label="{{__('table.description_ru')}}*"
            placeholder="{{__('table.description_ru')}}"
            hint="{{__('table.description_ru')}}"
        />
    </div>
    {{--    Description Ru --}}
    {{--    Description Kk --}}
    <div class="form-group">
        <x-textarea
            wire:model="description_kk"
            label="{{__('table.description_kk')}}*"
            placeholder="{{__('table.description_kk')}}"
            hint="{{__('table.description_kk')}}"
        />
    </div>
    {{--    Description Kk --}}
    {{--    Description En --}}
    <div class="form-group">
        <x-textarea
            wire:model="description_en"
            label="{{__('table.description_en')}}"
            placeholder="{{__('table.description_en')}}"
            hint="{{__('table.description_en')}}"
        />
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
    <x-datetime-picker
        label="{{__('table.start_at')}} *"
        time-format="24"
        parse-format="DD-MM-YYYY HH:mm"
        :min="now()"
        :max="now()->addYear(2)"
        wire:model="start_at"
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
        wire:model="end_at"
        hint="{{__('table.end_at')}}"
    />
    {{--End At --}}
</x-form-component.form-component>
