@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.subscription_lists')"
        :subtitle="__('table.subscription_management')"
        :breadcrumbs="[__('table.subscription_management')]"
        :routes="['subscription.index']"
    >
        <a href="{{route("subscription.create")}}" class="btn btn-primary mt-2 mt-xl-0">Создать новую подписку</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:subscription.subscription-table/>
            </div>
        </div>
    </div>


@endsection
