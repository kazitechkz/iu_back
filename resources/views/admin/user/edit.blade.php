@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Изменить пользователя ' . $user->name"
        :subtitle="'Блок редактирования пользователя'"
        :breadcrumbs="['Управление пользователями','Редактировать пользователя']"
    />

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:user.edit :user="$user"></livewire:user.edit>
            </div>
        </div>
    </div>


@endsection
