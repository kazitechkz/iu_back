@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.plan_combination_edit_title') . $plan_combination->name"
        :subtitle="__('table.plan_combination_edit_subtitle')"
        :breadcrumbs="[__('table.plan_combination_management'),__('table.plan_combination_edit_title')]"
        :routes="['plan-combination.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:plan-combination.edit :plan-combination="$plan_combination"></livewire:plan-combination.edit>
            </div>
        </div>
    </div>


@endsection
