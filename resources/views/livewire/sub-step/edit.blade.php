<x-form-component.form-component
    :method="'put'"
    :route="'sub-step.update'"
    :parameters="['sub_step'=>$sub_step]"
    :element-id="'sub-step-update'"
>
    <input type="hidden" wire:model="title_ru" name="title_ru">
    <input type="hidden" wire:model="title_kk" name="title_kk">
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
    {{--    Steps --}}
    <div class="form-group">
        <x-select
            label="Степ*"
            :options="$steps"
            option-label="title"
            option-value="id"
            wire:model="step_id"
            name="step_id"
        />
    </div>
    {{--    Steps --}}
    {{--    Sub-Category --}}
    <div class="form-group">
        <x-select
            label="Субстеп*"
            :options="$sub_categories"
            option-label="title"
            option-value="id"
            wire:model="sub_category_id"
            name="sub_category_id"
        />
    </div>
{{--        Sub-Category --}}
{{--        Title in Russian --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_ru"
                 label="Наименование на рус*"
                 placeholder="Наименование на рус"
                 icon="pencil"
                 hint="Title in Russian"
        />
    </div>
{{--        Title in Russian --}}
{{--        Title in Kazakh --}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="title_kk"
                 label="Наименование на каз*"
                 placeholder="Наименование на каз"
                 icon="pencil"
                 hint="Title in Kazakh"
        />
    </div>
{{--    --}}{{--    Title in Kazakh --}}
{{--    --}}{{--    Title in English --}}
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
    {{-- Level --}}
    <div class="form-group">
        <x-inputs.number
            label="Уровень*"
            wire:model="level"
            hint="Level - higher - more difficult"
        />
    </div>
    {{-- Level --}}

    {{-- Is Active --}}
    <x-checkbox
        id="is_active"
        label="Активный*"
        icon="check"
        wire:model.defer="is_active"
    />
    {{-- Is Active --}}



</x-form-component.form-component>

