@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создать Турнир'"
        :subtitle="'Управление Турнирами'"
        :breadcrumbs="['Управление Турнирами','Создать Турнир']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tournament.create/>
            </div>
        </div>
    </div>


@endsection
