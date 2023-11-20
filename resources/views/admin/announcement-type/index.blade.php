@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.announcement_type_lists')"
        :subtitle="__('table.announcement_type_management')"
        :breadcrumbs="[__('table.announcement_type_management')]"
        :routes="['announcement-type.index']"
    >
        <a href="{{route("announcement-type.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.announcement_type_create_title')}}

        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:announcement-type.announcement-type-table/>
            </div>
        </div>
    </div>


@endsection
