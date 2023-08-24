@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Турнирова'"
        :subtitle="'Управление Турнирами'"
        :breadcrumbs="['Управление Турнирами']"
    >
        <a href="{{route("tournament.create")}}" class="btn btn-primary mt-2 mt-xl-0">Добавить турниры</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tournament.tournament-table/>
            </div>
        </div>
    </div>


@endsection

