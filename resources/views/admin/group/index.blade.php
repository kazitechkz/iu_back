@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.group_lists')"
        :subtitle="__('table.group_management')"
        :breadcrumbs="[__('table.group_management')]"
        :routes="['group.index']"
    >
        <a href="{{route("group.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.group_create_subtitle')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:group.group-table/>
            </div>
        </div>
    </div>


@endsection
