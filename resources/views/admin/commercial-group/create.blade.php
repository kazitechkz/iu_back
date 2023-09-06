@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Группу Планов'"
        :subtitle="'Управление группами планов'"
        :breadcrumbs="['Управление Группами Планов','Создать Группу планов']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:commercial-group.create/>
            </div>
        </div>
    </div>


@endsection
