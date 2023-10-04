@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Видео Субэтапа'"
    >
        <a href="{{route("sub-step-video.create")}}" class="btn btn-primary mt-2 mt-xl-0">Добавить новый видео</a>
    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-step-video.table />
            </div>
        </div>
    </div>


@endsection
