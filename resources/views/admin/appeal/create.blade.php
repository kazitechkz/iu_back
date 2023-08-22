@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Аппеляцию'"
        :subtitle="'Управление Аппеляциями'"
        :breadcrumbs="['Управление Аппеляциями','Создать Аппеляцию']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:appeal.create/>
            </div>
        </div>
    </div>


@endsection
