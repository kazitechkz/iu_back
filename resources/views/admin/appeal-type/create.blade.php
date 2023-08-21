@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Тип Аппеляции'"
        :subtitle="'Управление Типами Аппеляции'"
        :breadcrumbs="['Управление Типами Аппеляции','Создать Тип Аппеляции']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:appeal-type.create/>
            </div>
        </div>
    </div>


@endsection
