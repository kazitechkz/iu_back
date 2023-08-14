@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список пользователей'"
        :subtitle="'Управление пользователями'"
        :breadcrumbs="['Управление пользователями']"
    >
        <a href="{{route("user.create")}}" class="btn btn-primary mt-2 mt-xl-0">Add new User</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:user-table theme="tailwind" />
            </div>
        </div>
    </div>


@endsection
