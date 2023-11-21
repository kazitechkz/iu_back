@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.notification_edit_title')"
        :subtitle="__('table.notification_edit_subtitle')"
        :breadcrumbs="[__('table.notification_management'),__('table.notification_edit_title')]"
        :routes="['notification.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:notification.edit :notification="$notification"/>
            </div>
        </div>
    </div>


@endsection
