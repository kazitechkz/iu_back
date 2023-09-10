@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.role_create_title')"
        :subtitle="__('table.role_create_subtitle')"
        :breadcrumbs="[__('table.role_management'),__('table.role_create_title')]"
        :routes="['role.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:role.create></livewire:role.create>
            </div>
        </div>
    </div>


@endsection
