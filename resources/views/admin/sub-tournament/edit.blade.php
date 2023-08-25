@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Изменить Субтурнир'"
        :subtitle="'Управление Субтурнирами'"
        :breadcrumbs="['Управление Субтурнир','Изменить Субтурнирами']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-tournament.edit :sub-tournament="$sub_tournament"/>
            </div>
        </div>
    </div>


@endsection
