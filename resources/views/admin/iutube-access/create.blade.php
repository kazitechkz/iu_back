@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.iutube_access_lists')"
        :subtitle="__('table.iutube_access_create_subtitle')"
        :breadcrumbs="[__('table.iutube_access_management'),__('table.iutube_access_create_title')]"
        :routes="['iutube-access.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:i-u-tube-access.create/>
            </div>
        </div>
    </div>


@endsection
