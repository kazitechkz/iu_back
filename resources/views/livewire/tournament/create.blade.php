<x-form-component.form-component
    :method="'post'"
    :route="'tournament.store'"
    :element-id="'tournament-create'"
>
    {{--    Subject  --}}
    <div class="form-group">
        <x-select
            label="Subject*"
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
                 label="Title in Russian*"
                 placeholder="Title In Russian"
                 icon="pencil"
                 hint="Title in Russian is required"
        />
    </div>
    {{--    Title Ru--}}
    {{--    Title Kk --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_kk"
                 label="Title in Kazakh*"
                 placeholder="Title In Kazakh"
                 icon="pencil"
                 hint="Title in Kazakh is required"
        />
    </div>
    {{--    Title Kk--}}
    {{--    Title En --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_en"
                 label="Title in English"
                 placeholder="Title In English"
                 icon="pencil"
                 hint="Title in English is not required"
        />
    </div>
    {{--    Title En--}}
    {{--    Rule Ru --}}
    <div class="form-group">
        <x-textarea
            wire:model="rule_ru"
            label="Rule in Russian*"
            placeholder="Rule in russian"
            hint="Rules in russian"
        />
    </div>
    {{--    Rule Ru --}}
    {{--    Rule Kk --}}
    <div class="form-group">
        <x-textarea
            wire:model="rule_kk"
            label="Rule in Kazakh*"
            placeholder="Rule in Kazakh"
            hint="Rules in Kazakh"
        />
    </div>
    {{--    Rule Kk --}}
    {{--    Rule En --}}
    <div class="form-group">
        <x-textarea
            wire:model="rule_en"
            label="Rule in English"
            placeholder="Rule in English"
            hint="Rules in English"
        />
    </div>
    {{--    Rule En --}}

    {{--    Description Ru --}}
    <div class="form-group">
        <x-textarea
            wire:model="description_ru"
            label="Description in Russian*"
            placeholder="Description in russian"
            hint="Description in russian"
        />
    </div>
    {{--    Description Ru --}}
    {{--    Description Kk --}}
    <div class="form-group">
        <x-textarea
            wire:model="description_kk"
            label="Description in Kazakh*"
            placeholder="Description in Kazakh"
            hint="Description in Kazakh"
        />
    </div>
    {{--    Description Kk --}}
    {{--    Description En --}}
    <div class="form-group">
        <x-textarea
            wire:model="description_en"
            label="Description in English"
            placeholder="Description in English"
            hint="Description in English"
        />
    </div>
    {{--    Description En --}}
    {{-- Price --}}
    <div class="form-group">
        <x-inputs.number
            label="Price*"
            prefix="KZT"
            wire:model="price"
            hint="Price in Kazakh Tenge"
        />
    </div>
    {{-- Price --}}
    {{-- currency--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="currency"
                 label="Currency*"
                 placeholder="KZT USD EUR "
                 icon="pencil"
                 hint="Currency in ISO 4217 format"
        />
    </div>
    {{-- currency --}}
    {{-- Poster --}}
    <label class="h-5">Poster*</label>
    <livewire:image-upload :output_name="'poster'" :folder-name="'news'"/>
    {{-- Poster --}}
    {{--    Status --}}
    <div class="form-group">
        <x-select
            label="Status*"
            :options="[
                ['name'=>'Регистрация завершена','value'=>-1],
                ['name'=>'Ожидание открытия','value'=>0],
                ['name'=>'Открыта регистрация','value'=>0],
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
        label="Start At *"
        time-format="24"
        parse-format="DD-MM-YYYY HH:mm"
        :min="now()"
        :max="now()->addYear(2)"
        wire:model="start_at"
        hint="Start At"
    />
    {{--Start At --}}
    {{-- End At --}}
    <x-datetime-picker
        label="End At *"
        time-format="24"
        parse-format="DD-MM-YYYY HH:mm"
        :min="now()"
        :max="now()->addYear(2)"
        wire:model="end_at"
        hint="End At"
    />
    {{--End At --}}
</x-form-component.form-component>
