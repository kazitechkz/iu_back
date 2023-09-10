@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.plan_create_title')"
        :subtitle="__('table.plan_create_subtitle')"
        :breadcrumbs="[__('table.plan_management'),__('table.plan_create_title')]"
        :routes="['plan.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:plan.create></livewire:plan.create>
            </div>
        </div>
    </div>


@endsection
