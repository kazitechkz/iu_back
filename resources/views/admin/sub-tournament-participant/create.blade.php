@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.sub_tournament_participant_create_title')"
        :subtitle="__('table.sub_tournament_participant_create_subtitle')"
        :breadcrumbs="[__('table.sub_tournament_participant_management'),__('table.sub_tournament_participant_create_title')]"
        :routes="['sub-tournament-participant.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-tournament-participant.create/>
            </div>
        </div>
    </div>


@endsection
