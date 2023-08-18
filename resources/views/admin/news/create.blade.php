@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Новость'"
        :subtitle="'Управление Новостями'"
        :breadcrumbs="['Управление Новостями','Создать Новость']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:news.create></livewire:news.create>
            </div>
        </div>
    </div>


@endsection
