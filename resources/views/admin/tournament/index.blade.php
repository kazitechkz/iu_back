@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.tournament_lists')"
        :subtitle="__('table.tournament_management')"
        :breadcrumbs="[__('table.tournament_management')]"
        :routes="['tournament.index']"
    >
        <a href="{{route("tournament.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.tournament_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tournament.tournament-table/>
            </div>
        </div>
    </div>

@endsection

