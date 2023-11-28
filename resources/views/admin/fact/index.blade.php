@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список фактов'"
        :subtitle="'Управление фактами'"
    >
        <a href="{{route("fact.create")}}" class="btn btn-primary mt-2 mt-xl-0">Создать</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:fact.fact-table theme="tailwind" />
            </div>
        </div>
    </div>


@endsection

