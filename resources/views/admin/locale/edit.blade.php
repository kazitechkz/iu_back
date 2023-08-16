@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать Локаль'"
        :subtitle="'Редактирование Локали'"
        :breadcrumbs="['Управление Локалями','Редактирование Локали']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:locale.edit :locale="$locale"/>
            </div>
        </div>
    </div>


@endsection
