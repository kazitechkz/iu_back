@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Контент Субэтапа'"
        :subtitle="'Управление Контентами Субэтапа'"
        :breadcrumbs="['Управление Контентами Субэтапа','Создать Контент Субэтапа']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-step-content.create/>
            </div>
        </div>
    </div>


@endsection
