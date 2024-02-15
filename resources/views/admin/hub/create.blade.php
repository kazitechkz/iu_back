@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Создание группы'"
        :subtitle="''"
    />

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:hub.create></livewire:hub.create>
            </div>
        </div>
    </div>


@endsection
