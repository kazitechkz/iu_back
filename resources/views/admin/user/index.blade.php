@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.user_lists')"
        :subtitle="__('table.user_management')"
        :breadcrumbs="[__('table.user_management')]"
        :routes="['user.index']"
    >
        <a href="{{route("user.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.user_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:user-table theme="tailwind" />
            </div>
        </div>
    </div>


@endsection
