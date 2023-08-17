@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Локализацию Плана Подписки'"
        :subtitle="'Управление Локализациями подписок'"
        :breadcrumbs="['Управление Планами','Создать Локализациями подписок']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:plan-combination.create></livewire:plan-combination.create>
            </div>
        </div>
    </div>


@endsection
