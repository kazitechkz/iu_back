@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.commercial_lists')"
        :subtitle="__('table.commercial_management')"
        :breadcrumbs="[__('table.commercial_management')]"
        :routes="['commercial-group.index']"
    >
        <a href="{{route("commercial-group.create")}}"
           class="btn btn-primary mt-2 mt-xl-0">
            {{__("table.commercial_create_subtitle")}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:commercial-group.commercial-group-table/>
            </div>
        </div>
    </div>


@endsection

