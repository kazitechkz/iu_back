@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.tournament_prize_create_title')"
        :subtitle="__('table.tournament_prize_create_subtitle')"
        :breadcrumbs="[__('table.tournament_prize_management'),__('table.tournament_prize_create_title')]"
        :routes="['tournament-prize.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tournament-prize.create/>
            </div>
        </div>
    </div>


@endsection
