@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Локализаций'"
        :subtitle="'Управление Локализациями'"
        :breadcrumbs="['Управление Локализациями']"
    >
        <a href="{{route("locale.create")}}" class="btn btn-primary mt-2 mt-xl-0">Добавить новую локаль</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:locale.locale-table>
            </div>
        </div>
    </div>


@endsection
