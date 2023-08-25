@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Список Участников Плейофф'"
        :subtitle="'Управление Списками Участников Плейофф'"
        :breadcrumbs="['Управление Управление Списками Участников Плейофф']"
    >

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:sub-tournament-rival.sub-tournament-rival-table/>
            </div>
        </div>
    </div>

@endsection

