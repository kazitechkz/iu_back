@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список плана подписок'"
        :subtitle="'Управление планами подписок'"
    >
        <a href="{{route("plan.create")}}" class="btn btn-primary mt-2 mt-xl-0">Создать</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>


@endsection
