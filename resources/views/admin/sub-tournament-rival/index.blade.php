@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.sub_tournament_rival_lists')"
        :subtitle="__('table.sub_tournament_rival_management')"
        :breadcrumbs="[__('table.sub_tournament_rival_management')]"
        :routes="['sub-tournament-rival.index']"
    >

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-tournament-rival.sub-tournament-rival-table/>
            </div>
        </div>
    </div>

@endsection

