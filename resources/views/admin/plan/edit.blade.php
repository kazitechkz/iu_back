@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.plan_edit_title') . $plan->name"
        :subtitle="__('table.plan_edit_subtitle')"
        :breadcrumbs="[__('table.plan_management'),__('table.plan_edit_title')]"
        :routes="['plan.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:plan.edit :plan="$plan"></livewire:plan.edit>
            </div>
        </div>
    </div>


@endsection
