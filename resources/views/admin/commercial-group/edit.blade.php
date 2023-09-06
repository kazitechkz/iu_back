@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Редактировать Группу Планов'"
        :subtitle="'Управление Группами Планов'"
        :breadcrumbs="['Управление Группами Планов','Редактировать Группу Планов']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:commercial-group.edit :commercial_group="$commercial_group"/>
            </div>
        </div>
    </div>


@endsection
