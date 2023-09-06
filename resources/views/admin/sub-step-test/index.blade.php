@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список тестов'"
        :subtitle="'Управление тестов'"
    >
        <a href="{{route("sub-step-test.create")}}" class="btn btn-primary mt-2 mt-xl-0">Создать</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-step-test.sub-step-test-table theme="tailwind" />
            </div>
        </div>
    </div>


@endsection

