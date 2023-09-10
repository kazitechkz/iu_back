@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.subscription_edit_title') . $subscription->name"
        :subtitle="__('table.subscription_edit_subtitle')"
        :breadcrumbs="[__('table.subscription_management'),__('table.subscription_edit_title')]"
        :routes="['subscription.index']"
    />

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:subscription.edit :subscription="$subscription"/>
            </div>
        </div>
    </div>


@endsection
