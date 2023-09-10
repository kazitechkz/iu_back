@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.sub_tournament_result_lists')"
        :subtitle="__('table.sub_tournament_result_management')"
        :breadcrumbs="[__('table.sub_tournament_result_management')]"
        :routes="['sub-tournament-result.index']"
    >

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-tournament-result.sub-tournament-result-table/>
            </div>
        </div>
    </div>

@endsection

