@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.tournament_awards_lists')"
        :subtitle="__('table.tournament_awards_management')"
        :breadcrumbs="[__('table.tournament_awards_management')]"
    >
    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tournament-award.tournament-award-table/>
            </div>
        </div>
    </div>

@endsection
