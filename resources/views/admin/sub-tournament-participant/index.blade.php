@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.sub_tournament_participant_lists')"
        :subtitle="__('table.sub_tournament_participant_management')"
        :breadcrumbs="[__('table.sub_tournament_participant_management')]"
        :routes="['sub-tournament-participant.index']"
    >
        <a href="{{route("sub-tournament-participant.create")}}" class="btn btn-primary mt-2 mt-xl-0">Добавить участника</a>
    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-tournament-participant.sub-tournament-participant-table/>
            </div>
        </div>
    </div>

@endsection

