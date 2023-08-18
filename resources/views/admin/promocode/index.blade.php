@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список промокодов'"
        :subtitle="'Управление промокодами'"
        :breadcrumbs="['Управление промокодами']"
    >
        <a href="{{route("promocode.create")}}" class="btn btn-primary mt-2 mt-xl-0">Создать новую подписку</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:promocode.promocode-table/>
            </div>
        </div>
    </div>


@endsection
