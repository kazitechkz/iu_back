@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.permission_lists')"
        :subtitle="__('table.permission_management')"
        :breadcrumbs="[__('table.permission_management')]"
        :routes="['permission.index']"
    >
        <a href="{{route("permission.create")}}"
           class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.permission_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:permission.permission-table/>
            </div>
        </div>
    </div>


@endsection

