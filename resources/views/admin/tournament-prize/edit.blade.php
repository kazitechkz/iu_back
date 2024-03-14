@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.tournament_prize_edit_title') . $tournamentPrize->title_ru"
        :subtitle="__('table.tournament_prize_edit_subtitle')"
        :breadcrumbs="[__('table.tournament_prize_management'),__('table.tournament_prize_edit_title')]"
        :routes="['tournament-prize.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tournament-prize.edit :tournamentPrize="$tournamentPrize"/>
            </div>
        </div>
    </div>


@endsection
