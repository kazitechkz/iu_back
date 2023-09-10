<x-form-component.form-component
    :method="'post'"
    :route="'permission.store'"
    :element-id="'permission-create'"
>
    {{--    Permission Name--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="name"
                 label="{{__('table.permission_id')}}*"
                 placeholder="{{__('table.permission_id')}}"
                 icon="user"
                 hint="{{__('table.permission_id')}}"
        />
    </div>
    {{--    Permission Name--}}
    {{--    Permission Guard--}}
    <div class="form-group">
        <x-select
            label="{{__('table.guard_name')}} *"
            placeholder="{{__('table.guard_name')}}"
            :options="['web']"
            wire:model="guard_name"
            name="guard_name"
        />
    </div>
    {{--    Permission Guard --}}



</x-form-component.form-component>
