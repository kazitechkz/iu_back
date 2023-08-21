@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать Тип Аппеляции'"
        :subtitle="'Управление Аппеляциями'"
        :breadcrumbs="['Управление Типами Аппеляций','Редактировать Тип Аппеляции']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:appeal-type.edit :appeal-type="$appeal_type"/>
            </div>
        </div>
    </div>


@endsection
