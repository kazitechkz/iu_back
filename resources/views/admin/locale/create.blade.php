@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Локаль'"
        :subtitle="'Управление Локалями'"
        :breadcrumbs="['Управление Локалями','Создать Локали']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:locale.create/>
            </div>
        </div>
    </div>


@endsection
