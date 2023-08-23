<x-form-component.form-component
    :method="'post'"
    :route="'discuss.store'"
    :element-id="'discuss-create'"
>
    {{--    Forum --}}
    <div class="form-group">
        <x-select
            label="Forum*"
            placeholder="Choose forum"
            :options="$forums"
            :option-label="'text'"
            :option-value="'id'"
            wire:model="forum_id"
            name="forum_id"
        />
    </div>
    {{--    Forum --}}
    {{--    Text--}}
    <div class="form-group">
        <x-textarea
            wire:model="text"
            label="Comment*"
            placeholder="Comment"
            hint="Comment"
        />
    </div>
    {{--    Text --}}

</x-form-component.form-component>
