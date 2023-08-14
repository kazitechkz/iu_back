@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Изменить Разрешение '"
        :subtitle="'Управление Разрешениями'"
        :breadcrumbs="['Управление Разрешениями','Изменить Разрешение']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:permission.edit :permission="$permission"></livewire:permission.edit>
            </div>
        </div>
    </div>


@endsection
