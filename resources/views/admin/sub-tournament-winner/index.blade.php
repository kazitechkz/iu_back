@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Победителей'"
        :subtitle="'Управление Победителями'"
        :breadcrumbs="['Управление Победителями']"
    >
    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-tournament-winner.sub-tournament-winner-table/>
            </div>
        </div>
    </div>
@endsection

