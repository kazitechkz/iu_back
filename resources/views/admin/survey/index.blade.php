@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Опросники'"
        :subtitle="''"
        :routes="['survey.index']"
    >
        <a href="{{route("survey.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            Создать опросник
        </a>
    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:survey.index-table />
            </div>
        </div>
    </div>


@endsection
