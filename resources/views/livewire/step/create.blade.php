<x-form-component.form-component
    :method="'post'"
    :route="'step.store'"
    :element-id="'step-create'"
>

    <input type="hidden" wire:model="title_ru" name="title_ru">
    <input type="hidden" wire:model="title_kk" name="title_kk">
    {{--    Title in Russian --}}
{{--    <div class="form-group">--}}
{{--        <x-input class="my-2"--}}
{{--                 wire:model="title_ru"--}}
{{--                 label="Title in Russian*"--}}
{{--                 placeholder="Title in Russian"--}}
{{--                 icon="pencil"--}}
{{--                 hint="Title in Russian"--}}
{{--        />--}}
{{--    </div>--}}
{{--    --}}{{--    Title in Russian --}}
{{--    --}}{{--    Title in Kazakh --}}
{{--    <div class="form-group">--}}
{{--        <x-input class="my-2"--}}
{{--                 wire:model="title_kk"--}}
{{--                 label="Title in Kazakh*"--}}
{{--                 placeholder="Title in Kazakh"--}}
{{--                 icon="pencil"--}}
{{--                 hint="Title in Kazakh"--}}
{{--        />--}}
{{--    </div>--}}
    {{--    Title in Kazakh --}}
    {{--    Title in English --}}
{{--    <div class="form-group">--}}
{{--        <x-input class="my-2"--}}
{{--                 wire:model="title_en"--}}
{{--                 label="Title in English"--}}
{{--                 placeholder="Title in English"--}}
{{--                 icon="pencil"--}}
{{--                 hint="Title in English"--}}
{{--        />--}}
{{--    </div>--}}
    {{--    Title in English --}}

    {{--    Subjects --}}
    <div class="form-group">
        <x-select
            label="Предмет*"
            :options="$subjects"
            option-label="title"
            option-value="id"
            wire:model="subject_id"
            name="subject_id"
        />
    </div>
    {{--    Subjects --}}

    {{--    Categories --}}
    <div class="form-group">
        <x-select
            label="Категория*"
            :options="$categories"
            option-label="title"
            option-value="id"
            wire:model="category_id"
            name="category_id"
        />
    </div>
    {{--    Categories --}}
    {{-- Level --}}
    <div class="form-group">
        <x-inputs.number
            label="Уровень*"
            wire:model="level"
            hint="Level - higher - more difficult"
        />
    </div>
    {{-- Level --}}
    {{--    Plans --}}
    @if($plans)
        <div class="form-group">
            <x-select
                label="План*"
                :options="$plans"
                option-label="name"
                option-value="id"
                wire:model="plan_id"
                name="plan_id"
            />
        </div>
    @endif
    {{--    Plans--}}
    {{-- Image Url --}}
    <label class="h-5">Картинка*</label>
    <livewire:image-upload :folder-name="'step'"/>
    {{-- Image Url --}}

    {{-- Is Active --}}
    <x-checkbox
        id="is_active"
        label="Активный*"
        icon="check"
        wire:model.defer="is_active"
    />
    {{-- Is Active --}}

    {{-- Is Free --}}
    <x-checkbox
        id="is_free"
        label="Бесплатен*"
        icon="check"
        wire:model.defer="is_free"
    />
    {{-- Is Free --}}

</x-form-component.form-component>

