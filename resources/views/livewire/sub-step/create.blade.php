<x-form-component.form-component
    :method="'post'"
    :route="'sub-step.store'"
    :element-id="'sub-step-create'"
>
    {{--    Steps --}}
    @if($steps)
        <div class="form-group">
            <x-select
                label="Step*"
                :options="$steps"
                option-label="title_ru"
                option-value="id"
                wire:model="step_id"
                name="step_id"
            />
        </div>
    @endif
    {{--    Steps --}}
    {{--    Sub-Category --}}
    @if($sub_categories)
        <div class="form-group">
            <x-select
                label="Sub-Category*"
                :options="$sub_categories"
                option-label="title_ru"
                option-value="id"
                wire:model="sub_category_id"
                name="sub_category_id"
            />
        </div>
    @endif
    {{--    Sub-Category --}}
{{--    Title in Russian --}}
<div class="form-group">
    <x-input class="my-2"
             wire:model="title_ru"
             label="Title in Russian*"
             placeholder="Title in Russian"
             icon="pencil"
             hint="Title in Russian"
    />
</div>
{{--    Title in Russian --}}
{{--    Title in Kazakh --}}
<div class="form-group">
    <x-input class="my-2"
             wire:model="title_kk"
             label="Title in Kazakh*"
             placeholder="Title in Kazakh"
             icon="pencil"
             hint="Title in Kazakh"
    />
</div>
{{--    Title in Kazakh --}}
{{--    Title in English --}}
<div class="form-group">
    <x-input class="my-2"
             wire:model="title_en"
             label="Title in English"
             placeholder="Title in English"
             icon="pencil"
             hint="Title in English"
    />
</div>
{{--    Title in English --}}
{{-- Level --}}
<div class="form-group">
    <x-inputs.number
        label="Level*"
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
