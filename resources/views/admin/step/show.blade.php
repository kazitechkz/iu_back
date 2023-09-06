@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Просмотр Этапов'"
        :subtitle="'Управление Этапами'"
        :breadcrumbs="['Управление Этапами']"
    >
        <a href="{{route("step.create")}}" class="btn btn-primary mt-2 mt-xl-0">Добавить новый этап</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-step.sub-step-table :step="$step" />
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-step.create :step="$step"/>
            </div>
        </div>
    </div>

@endsection
