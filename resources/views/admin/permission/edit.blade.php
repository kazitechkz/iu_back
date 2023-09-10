@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.permission_edit_title') . $permission->name"
        :subtitle="__('table.permission_edit_subtitle')"
        :breadcrumbs="[__('table.permission_management'),__('table.permission_edit_title')]"
        :routes="['permission.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:permission.edit :permission="$permission"></livewire:permission.edit>
            </div>
        </div>
    </div>


@endsection
