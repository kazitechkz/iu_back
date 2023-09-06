@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Контентов Субэтапа'"
        :subtitle="'Управление Контентом субэтапов'"
        :breadcrumbs="['Управление Контентом субэтапов']"
    >
        <a href="{{route("sub-step-content.create")}}" class="btn btn-primary mt-2 mt-xl-0">Добавить новый контент</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-step-content.sub-step-content-table/>
            </div>
        </div>
    </div>


@endsection
