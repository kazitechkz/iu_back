@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.sub_tournament_lists')"
        :subtitle="__('table.sub_tournament_management')"
        :breadcrumbs="[__('table.sub_tournament_management')]"
        :routes="['sub-tournament.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-tournament.sub-tournament-table/>
            </div>
        </div>
    </div>


@endsection
