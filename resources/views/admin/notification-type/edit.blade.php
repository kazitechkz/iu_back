@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.notification_type_edit_title')"
        :subtitle="__('table.notification_type_edit_subtitle')"
        :breadcrumbs="[__('table.notification_type_management'),__('table.notification_type_edit_title')]"
        :routes="['notification-type.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:notification-type.edit :notification_type="$notification_type"/>
            </div>
        </div>
    </div>


@endsection
