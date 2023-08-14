@extends('layouts.default')
@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <x-form-component.form-component
                    :method="'post'"
                    :route="'user.store'"
                    :element-id="'user-create'"
                >
                    {{--    User Name--}}
                    <div class="form-group">
                        <x-input class="my-2"
                                 wire:model="name"
                                 label="Name*"
                                 placeholder="UserName"
                                 icon="user"
                                 hint="Фамилия имя отчество"
                        />
                        <x-errors :only="'name'" />
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
                        <x-errors :only="'username'" />
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
                        <x-errors :only="'email'" />
                    </div>
                    {{--    User Email--}}
                    {{--    User Password--}}
                    <div class="form-group">
                        <x-inputs.password
                            label="Пароль*"
                            wire:model="password"
                            icon="lock-closed"
                            hint="Пароль должен иметь более 5 знаков, содержать спец символы"
                            value="" />
                        <x-errors :only="'password'" />
                    </div>
                    {{--    User Password--}}
                    {{--    User Role--}}
                    <div class="form-group">
                        <livewire:phone />
                        <x-errors :only="'phone'" />
                    </div>
                    {{--    User Role--}}
                    {{--    User Role--}}
                    <div class="form-group">
                        <livewire:select
                            :name="'role'"
                            :option_label="'name'"
                            :option_value="'guard_name'"
                            :placeholder="'Choose your role'"
                            :label="'Role*'"
                            :options="$roles"/>
                    </div>
                    <x-errors :only="'role'" />
                    {{--    User Role--}}
                </x-form-component.form-component>
            </div>
        </div>
    </div>


@endsection
