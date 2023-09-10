@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.sub_tournament_winner_lists')"
        :subtitle="__('table.sub_tournament_winner_management')"
        :breadcrumbs="[__('table.sub_tournament_winner_management')]"
        :routes="['sub-tournament-winner.index']"
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

