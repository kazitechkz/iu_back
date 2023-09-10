@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.role_lists')"
        :subtitle="__('table.role_management')"
        :breadcrumbs="[__('table.role_management')]"
        :routes="['role.index']"
    >
        <a href="{{route("role.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.role_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:role.role-table></livewire:role.role-table>
            </div>
        </div>
    </div>


@endsection
