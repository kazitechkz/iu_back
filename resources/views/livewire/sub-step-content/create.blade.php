<x-form-component.form-component
    :method="'post'"
    :route="'sub-step-content.store'"
    :element-id="'sub-step-content-create'"
>
    {{--    Sub-Steps --}}
    @if($sub_steps)
        <div class="form-group">
            <x-select
                label="Sub-Steps*"
                :options="$sub_steps"
                option-label="title_ru"
                option-value="id"
                wire:model="sub_step_id"
                name="sub_step_id"
            />
        </div>
    @endif
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
