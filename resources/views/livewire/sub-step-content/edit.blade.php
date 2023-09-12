<x-form-component.form-component
    :method="'put'"
    :route="'sub-step-content.update'"
    :parameters="['sub_step_content'=>$sub_step_content]"
    :element-id="'sub-step-content-update'"
>
    {{--    Sub-Steps --}}
    <div class="form-group">
        <x-select
            label="Степы*"
            :options="$steps"
            option-label="title"
            option-value="id"
            wire:model="step_id"
        />
    </div>
    {{--    Sub-Steps --}}
    {{--    Sub-Steps --}}
    <div class="form-group">
        <x-select
            label="Субстепы*"
            :options="$sub_steps"
            option-label="title_ru"
            option-value="id"
            wire:model="sub_step_id"
            name="sub_step_id"
        />
    </div>
    {{--    Sub-Steps --}}
    {{--    CkEditor --}}
    <div class="form-group" wire:ignore>
        <x-ckeditor :title="'Контент на русском*'" :description="$text_ru" :input-name="'text_ru'"/>
    </div>
    {{--    CkEditor --}}
    {{--    CkEditor --}}
    <div class="form-group" wire:ignore>
        <x-ckeditor :title="'Контент на казахском*'" :description="$text_kk" :input-name="'text_kk'"/>
    </div>
    {{--    CkEditor --}}
    {{--    CkEditor --}}
    <div class="form-group" wire:ignore>
        <x-ckeditor :title="'Контент на английском'" :description="$text_en" :input-name="'text_en'"/>
    </div>
    {{--    CkEditor --}}
    {{-- Is Active --}}
    <x-checkbox
        id="is_active"
        label="Активный*"
        icon="check"
        wire:model.defer="is_active"
    />
    {{-- Is Active --}}



</x-form-component.form-component>
