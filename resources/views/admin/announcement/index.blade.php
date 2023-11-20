@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.announcement_lists')"
        :subtitle="__('table.announcement_management')"
        :breadcrumbs="[__('table.announcement_management')]"
        :routes="['announcement.index']"
    >
        <a href="{{route("announcement.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.announcement_create_title')}}

        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:announcement.announcement-table/>
            </div>
        </div>
    </div>


@endsection
