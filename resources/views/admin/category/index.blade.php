@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список категории'"
        :subtitle="'Управление категориями'"
    >
        <a href="{{route("categories.create")}}" class="btn btn-primary mt-2 mt-xl-0">Создать</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:category.category-table theme="tailwind" />
            </div>
        </div>
    </div>


@endsection

