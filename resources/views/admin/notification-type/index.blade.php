@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.notification_type_lists')"
        :subtitle="__('table.notification_type_management')"
        :breadcrumbs="[__('table.notification_type_management')]"
        :routes="['notification-type.index']"
    >
        <a href="{{route("notification-type.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.notification_type_create_title')}}

        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:notification-type.notification-type-table/>
            </div>
        </div>
    </div>


@endsection
