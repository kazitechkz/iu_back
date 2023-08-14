<x-form-component.form-component
    :method="'put'"
    :route="'role.update'"
    :parameters="['role'=>$role]"
    :element-id="'role-create'"
>
    {{--    Role Name--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="name"
                 label="Role Name*"
                 placeholder="Role Name"
                 icon="user"
                 hint="Role name"
        />
    </div>
    {{--    Role Name--}}
    {{--    Role Guard--}}
    <div class="form-group">
        <x-select
            label="Guard Name *"
            placeholder="Choose Guard"
            :options="['web']"
            wire:model="guard_name"
            name="guard_name"
        />
    </div>
    {{--    Role Guard --}}



</x-form-component.form-component>
