@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Результатов'"
        :subtitle="'Управление Результатов'"
        :breadcrumbs="['Управление Результатов']"
    >

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-tournament-result.sub-tournament-result-table/>
            </div>
        </div>
    </div>

@endsection

