@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="'Планы промокодов'"
        :routes="['promocode-plans.index']"
    >
        <a href="{{route("promocode-plans.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            Создать план для промокода
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:promocode-plan.index-table />
            </div>
        </div>
    </div>


@endsection
