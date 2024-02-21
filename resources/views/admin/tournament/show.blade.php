@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Субтурниров'"
        :subtitle="'Управление Субтурнирами'"
        :breadcrumbs="['Управление Субтурнирами']"
    >
    </x-layer-components.content-navbar>
{{--    <div class="col-lg-12 grid-margin stretch-card">--}}
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--                <livewire:sub-tournament.sub-tournament-table :tournament="$tournament"/>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-tournament.create :tournament="$tournament"/>
            </div>
        </div>
    </div>


@endsection

