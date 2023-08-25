@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Субтурниров'"
        :subtitle="'Управление Субтурнирами'"
        :breadcrumbs="['Управление Субтурнирами']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-tournament.sub-tournament-table/>
            </div>
        </div>
    </div>


@endsection
