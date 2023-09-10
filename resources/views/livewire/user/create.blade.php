<x-form-component.form-component
    :method="'post'"
    :route="'user.store'"
    :element-id="'user-create'"
>

    {{--    User Name--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="name"
                 label="{{__('table.user_name')}}*"
                 placeholder="{{__('table.user_name_hint')}}"
                 icon="user"
                 hint="{{__('table.user_name')}}"
        />
    </div>
    {{--    User Name--}}
    {{--    NickName--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="username "
                 label="{{__('table.username')}}*"
                 placeholder="john_wick_2023"
                 icon="user"
                 hint="{{__('table.username_hint')}}"
        />
    </div>
    {{--    NickName--}}
    {{--    User Email--}}
    <div class="form-group">
        <x-input
            type="email"
            class="my-2"
            wire:model="email"
            label="{{__('table.email')}}*"
            placeholder="{{__('table.email_placeholder')}}"
            icon="mail"
            hint="{{__('table.email_hint')}}"
        />
    </div>
    {{--    User Email--}}
    {{--    User Password--}}
    <div class="form-group">
        <x-inputs.password
            label="{{__('table.password')}}*"
            wire:model="password"
            icon="lock-closed"
            hint="{{__('table.password_hint')}}"

        />
    </div>
    {{--    User Password--}}
    {{--    User Phone--}}
    <div class="form-group">
        <x-inputs.phone
            label="{{__('table.phone')}}*"
            placeholder="{{__('table.phone_placeholder')}}"
            hint="{{__('table.phone_hint')}}"
            wire:model="phone"
            icon="phone"
        />
    </div>
    {{--    User Phone--}}
    {{--    User Role--}}
    <div class="form-group">
        <x-select
            label="{{__('table.role_id')}}*"
            placeholder="{{__('table.role_id')}}"
            :options="$roles"
            :option-label="'name'"
            :option-value="'name'"
            wire:model="role"
            name="role"
        />
    </div>
    {{--    User Role--}}
</x-form-component.form-component>
