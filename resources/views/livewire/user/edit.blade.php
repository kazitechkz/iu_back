<x-form-component.form-component
    :method="'put'"
    :route="'user.update'"
    :parameters="['user'=>$user]"
    :element-id="'user-create'"
>
    <div class="form-group">
        <x-input class="my-2"
                 type="hidden"
                 wire:model="user_id"
                 value="{{$user->id}}"
        />
    </div>
    {{--    User Name--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="name"
                 label="Name*"
                 placeholder="UserName"
                 icon="user"
                 hint="Фамилия имя отчество"
        />
    </div>
    {{--    User Name--}}
    {{--    NickName--}}
    <div class="form-group">
        <x-input class="my-2"
                 wire:model="username "
                 label="UserName*"
                 placeholder="UserName"
                 icon="user"
                 hint="Уникальный логин"
        />
    </div>
    {{--    NickName--}}
    {{--    User Email--}}
    <div class="form-group">
        <x-input
            type="email"
            class="my-2"
            wire:model="email"
            label="Email*"
            placeholder="Email"
            icon="mail"
            hint="Укажите действующую почту"
        />
    </div>
    {{--    User Email--}}
    {{--    User Password--}}
    <div class="form-group">
        <x-inputs.password
            label="Пароль*"
            wire:model="password"
            icon="lock-closed"
            hint="Пароль должен иметь более 5 знаков, содержать спец символы"

        />
    </div>
    {{--    User Password--}}
    {{--    User Phone--}}
    <div class="form-group">
        <x-inputs.phone
            label="Phone*"
            hint="Only Kazakhstan Mobile"
            wire:model="phone"
            icon="phone"
        />
    </div>
    {{--    User Phone--}}
    {{--    User Role--}}
    <p>
        @if(count($user->getRoleNames()))
            @foreach($user->getRoleNames() as $roleName)
                {{$roleName}}
            @endforeach
        @endif
    </p>
    <div class="form-group">
        <x-select
            label="Role*"
            placeholder="Choose role"
            :options="$roles"
            :option-label="'name'"
            :option-value="'name'"
            wire:model="role"
            name="role"
        />
    </div>
    {{--    User Role--}}
</x-form-component.form-component>
