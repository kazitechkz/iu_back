@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.announcement_group_lists')"
        :subtitle="__('table.announcement_group_management')"
        :breadcrumbs="[__('table.announcement_group_management')]"
        :routes="['announcement-group.index']"
    >
        <a href="{{route("announcement-group.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.announcement_group_create_title')}}

        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:announcement-group.announcement-group-table/>
            </div>
        </div>
    </div>


@endsection
