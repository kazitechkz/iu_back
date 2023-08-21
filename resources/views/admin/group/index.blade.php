@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список групп вопросов'"
        :subtitle="'Управление группами вопросов'"
    >
        <a href="{{route("group.create")}}" class="btn btn-primary mt-2 mt-xl-0">Создать</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:group.group-table/>
            </div>
        </div>
    </div>


@endsection
