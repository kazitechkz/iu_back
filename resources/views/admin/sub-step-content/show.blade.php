@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Контенты Субэтапа'"
        :subtitle="'Управление Контентами Субэтапа'"
        :breadcrumbs="['Управление Контентами Субэтапа']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-step-content.create :sub_step="$sub_step"/>
            </div>
        </div>
    </div>


@endsection
