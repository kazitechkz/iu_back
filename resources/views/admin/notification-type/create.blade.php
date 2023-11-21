@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.notification_type_create_title')"
        :subtitle="__('table.notification_type_create_subtitle')"
        :breadcrumbs="[__('table.notification_type_management'),__('table.notification_type_create_title')]"
        :routes="['notification-type.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:notification-type.create/>
            </div>
        </div>
    </div>


@endsection
