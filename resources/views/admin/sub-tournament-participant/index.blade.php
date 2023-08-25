@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Участников'"
        :subtitle="'Управление Участниками'"
        :breadcrumbs="['Управление Участниками']"
    >

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-tournament-participant.sub-tournament-participant-table/>
            </div>
        </div>
    </div>

@endsection

