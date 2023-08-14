@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Разрешений'"
        :subtitle="'Управление Разрешениями'"
        :breadcrumbs="['Управление Разрешениями']"
    >
        <a href="{{route("permission.create")}}" class="btn btn-primary mt-2 mt-xl-0">Добавить новое разрешение</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:permission.permission-table/>
            </div>
        </div>
    </div>


@endsection

