@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.sub_tournament_edit_title') . $sub_tournament->title_ru"
        :subtitle="__('table.sub_tournament_edit_subtitle')"
        :breadcrumbs="[__('table.sub_tournament_management'),__('table.sub_tournament_edit_title')]"
        :routes="['sub-tournament.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-tournament.edit :sub-tournament="$sub_tournament"/>
            </div>
        </div>
    </div>


@endsection
