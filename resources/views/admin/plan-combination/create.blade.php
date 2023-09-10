@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.plan_combination_create_title')"
        :subtitle="__('table.plan_combination_create_subtitle')"
        :breadcrumbs="[__('table.plan_combination_management'),__('table.plan_combination_create_title')]"
        :routes="['plan-combination.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:plan-combination.create></livewire:plan-combination.create>
            </div>
        </div>
    </div>


@endsection
