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

    <div class="form-group">
            <label for="role_id">Role</label>
            <select name="role" class="form-control focus:outline-none shadow-sm text-dark" id="role_id" wire:model="role">
                @if(count($roles) > 0)
                    @foreach($roles as $role)
                        <option
                            value="{{$role["name"]}}"
                            >
                            {{$role["name"]}} {{$user->hasRole($role["name"]) == true ? "*" :""}}
                        </option>
                    @endforeach
                @endif
            </select>
    </div>
    {{--    User Role--}}
</x-form-component.form-component>
