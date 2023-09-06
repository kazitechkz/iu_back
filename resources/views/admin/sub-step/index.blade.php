@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Субэтапов'"
        :subtitle="'Управление Субэтапами'"
        :breadcrumbs="['Управление Субэтапами']"
    >
        <a href="{{route("sub-step.create")}}" class="btn btn-primary mt-2 mt-xl-0">Добавить новый субэтап</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-step.sub-step-table/>
            </div>
        </div>
    </div>


@endsection
