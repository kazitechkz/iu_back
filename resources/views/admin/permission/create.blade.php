@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Разрешение'"
        :subtitle="'Управление Разрешениями'"
        :breadcrumbs="['Управление Разрешениями','Создать Разрешение']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:permission.create/>
            </div>
        </div>
    </div>


@endsection
