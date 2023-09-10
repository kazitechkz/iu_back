@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.plan_combination_lists')"
        :subtitle="__('table.plan_combination_management')"
        :breadcrumbs="[__('table.plan_combination_management')]"
        :routes="['plan-combination.index']"
    >
        <a href="{{route("plan-combination.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.plan_combination_create_subtitle')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:plan-combination.plan-combination-table/>
            </div>
        </div>
    </div>


@endsection
