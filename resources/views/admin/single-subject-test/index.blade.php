@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список предметов'"
        :subtitle="'Управление предметами'"
    >
        <a href="{{route("single-subject-tests.create")}}" class="btn btn-primary mt-2 mt-xl-0">Создать</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:single-subject-test.create theme="tailwind" />
            </div>
        </div>
    </div>


@endsection

