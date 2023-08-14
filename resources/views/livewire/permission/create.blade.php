<x-form-component.form-component
    :method="'post'"
    :route="'permission.store'"
    :element-id="'permission-create'"
>
    {{--    Permission Name--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="name"
                 label="Permission Name*"
                 placeholder="Permission Name"
                 icon="user"
                 hint="Permission name"
        />
    </div>
    {{--    Permission Name--}}
    {{--    Permission Guard--}}
    <div class="form-group">
        <x-select
            label="Guard Name *"
            placeholder="Choose Guard"
            :options="['web']"
            wire:model="guard_name"
            name="guard_name"
        />
    </div>
    {{--    Permission Guard --}}



</x-form-component.form-component>
