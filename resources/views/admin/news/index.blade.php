@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Новостей'"
        :subtitle="'Управление Новостями'"
        :breadcrumbs="['Управление Новостями']"
    >
        <a href="{{route("news.create")}}" class="btn btn-primary mt-2 mt-xl-0">Добавить новость</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:news.news-table/>
            </div>
        </div>
    </div>


@endsection

