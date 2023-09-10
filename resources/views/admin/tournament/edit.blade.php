@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.tournament_edit_title') . $tournament->title_ru"
        :subtitle="__('table.tournament_edit_subtitle')"
        :breadcrumbs="[__('table.tournament_management'),__('table.tournament_edit_title')]"
        :routes="['tournament.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tournament.edit :tournament="$tournament"/>
            </div>
        </div>
    </div>


@endsection
