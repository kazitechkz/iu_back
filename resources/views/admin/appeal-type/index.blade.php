@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Типов Аппеляций'"
        :subtitle="'Управление Типами Аппеляции'"
    >
        <a href="{{route("appeal-type.create")}}" class="btn btn-primary mt-2 mt-xl-0">Создать</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:appeal-type.appeal-type-table/>
            </div>
        </div>
    </div>


@endsection
