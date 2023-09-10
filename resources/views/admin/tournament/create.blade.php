@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.tournament_create_title')"
        :subtitle="__('table.tournament_create_subtitle')"
        :breadcrumbs="[__('table.tournament_management'),__('table.tournament_create_title')]"
        :routes="['tournament.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tournament.create/>
            </div>
        </div>
    </div>


@endsection
