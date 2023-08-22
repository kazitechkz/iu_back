@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать Аппеляцию'"
        :subtitle="'Управление Аппеляциями'"
        :breadcrumbs="['Управление Типами Аппеляций','Редактировать Аппеляцию']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:appeal.edit :appeal="$appeal"/>
            </div>
        </div>
    </div>


@endsection

