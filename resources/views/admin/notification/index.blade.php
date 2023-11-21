@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.notification_lists')"
        :subtitle="__('table.notification_management')"
        :breadcrumbs="[__('table.notification_management')]"
        :routes="['notification.index']"
    >
        <a href="{{route("notification.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.notification_create_title')}}

        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:notification.notification-table/>
            </div>
        </div>
    </div>


@endsection
