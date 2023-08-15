<x-form-component.form-component
    :method="'post'"
    :route="'role.store'"
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

    {{-- Role Permission --}}
    <p class="h-3 mb-3 font-weight-bold">
        Permission:
    </p>
    <div class="form-group">
        @foreach($permissions as $permission)
            <x-checkbox
                value="{{$permission->name}}"
                id="{{$permission->name}}"
                name="permissions[]"
                multiple="multiple"
                selected
                label="{{$permission->name}}"
            />
        @endforeach
    </div>
    {{-- Role Permission --}}



</x-form-component.form-component>
