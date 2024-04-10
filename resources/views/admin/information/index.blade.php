@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.information_lists')"
        :subtitle="__('table.information_management')"
        :breadcrumbs="[__('table.information_management')]"
        :routes="['information.index']"
    >
        <a href="{{route("information.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.information_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:information.information-table/>
            </div>
        </div>
    </div>


@endsection
