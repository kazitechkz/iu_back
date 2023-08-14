@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать нового пользователя'"
        :subtitle="'Блок создания нового пользователя'"
        :breadcrumbs="['Управление пользователями','Создать нового пользователя']"
    />

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:user.create></livewire:user.create>
            </div>
        </div>
    </div>


@endsection
