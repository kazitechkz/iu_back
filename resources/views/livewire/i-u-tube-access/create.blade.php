<x-form-component.form-component
    :method="'post'"
    :route="'iutube-access.store'"
    :element-id="'iutube-access-create'"
>
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
    {{-- Is Active --}}
    <div class="form-group">
        <x-checkbox
            id="is_active"
            label="{{__('table.is_active')}}"
            icon="check"
            wire:model.defer="is_active"
        />
    </div>
    {{-- Is Active --}}
</x-form-component.form-component>

