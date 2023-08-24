@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Изменить Турнир'"
        :subtitle="'Управление Турнирами'"
        :breadcrumbs="['Управление Турнирами','Изменить Турнир']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tournament.edit :tournament="$tournament"/>
            </div>
        </div>
    </div>


@endsection
