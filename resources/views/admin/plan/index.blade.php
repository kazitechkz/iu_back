@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.plan_lists')"
        :subtitle="__('table.plan_management')"
        :breadcrumbs="[__('table.plan_management')]"
        :routes="['plan.index']"
    >
        <a href="{{route("plan.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.permission_create_subtitle')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:plan.plan-table/>
            </div>
        </div>
    </div>


@endsection
