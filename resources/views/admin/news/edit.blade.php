@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Изменить Новости '"
        :subtitle="'Управление Новостями'"
        :breadcrumbs="['Управление Новостями','Изменить Новость']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:news.edit :news="$news"></livewire:news.edit>
            </div>
        </div>
    </div>


@endsection
