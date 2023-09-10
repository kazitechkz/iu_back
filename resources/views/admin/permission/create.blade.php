@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.permission_create_title')"
        :subtitle="__('table.permission_create_subtitle')"
        :breadcrumbs="[__('table.permission_management'),__('table.permission_create_title')]"
        :routes="['permission.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:permission.create/>
            </div>
        </div>
    </div>


@endsection
