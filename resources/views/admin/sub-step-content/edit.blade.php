@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Изменить Контент Субэтапа'"
        :subtitle="'Управление Контентами Субэтапа'"
        :breadcrumbs="['Управление Контентами Субэтапа','Изменить Контент Субэтапа']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-step-content.edit :sub_step_content="$sub_step_content"/>
            </div>
        </div>
    </div>


@endsection
