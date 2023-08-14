@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать новый предмет'"
        :subtitle="'Блок создания нового предмета'"

    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="text-red-500 text-sm">Создать предмет</h1>
                <livewire:file-upload/>
            </div>
        </div>
    </div>


@endsection
