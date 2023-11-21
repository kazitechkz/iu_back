@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.notification_create_title')"
        :subtitle="__('table.notification_create_subtitle')"
        :breadcrumbs="[__('table.notification_management'),__('table.notification_create_title')]"
        :routes="['notification.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:notification.create/>
            </div>
        </div>
    </div>


@endsection
