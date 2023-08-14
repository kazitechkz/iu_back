@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Ролей'"
        :subtitle="'Управление Ролями'"
        :breadcrumbs="['Управление Ролями']"
    >
        <a href="{{route("role.create")}}" class="btn btn-primary mt-2 mt-xl-0">Добавить новую роль</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:role.role-table></livewire:role.role-table>
            </div>
        </div>
    </div>


@endsection
