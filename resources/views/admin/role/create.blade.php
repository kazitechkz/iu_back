@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Роль'"
        :subtitle="'Управление Ролями'"
        :breadcrumbs="['Управление Ролями','Создать роль']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:role.create></livewire:role.create>
            </div>
        </div>
    </div>


@endsection
