@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.iutube_access_lists')"
        :subtitle="__('table.iutube_access_management')"
        :breadcrumbs="[__('table.iutube_access_management')]"
        :routes="['iutube-access.index']"
    >
        <a href="{{route("iutube-access.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.iutube_access_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:i-u-tube-access.i-u-tube-access-table/>
            </div>
        </div>
    </div>


@endsection
