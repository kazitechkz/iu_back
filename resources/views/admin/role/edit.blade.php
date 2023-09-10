@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.role_edit_title') . $role->name"
        :subtitle="__('table.role_edit_subtitle')"
        :breadcrumbs="[__('table.role_management'),__('table.role_edit_title')]"
        :routes="['role.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:role.edit :role="$role"></livewire:role.edit>
            </div>
        </div>
    </div>


@endsection
