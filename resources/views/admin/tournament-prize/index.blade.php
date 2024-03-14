@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.tournament_prize_lists')"
        :subtitle="__('table.tournament_prize_management')"
        :breadcrumbs="[__('table.tournament_prize_management')]"
        :routes="['tournament-prize.index']"
    >
        <a href="{{route("tournament-prize.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.tournament_prize_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tournament-prize.tournament-prize-table/>
            </div>
        </div>
    </div>

@endsection
