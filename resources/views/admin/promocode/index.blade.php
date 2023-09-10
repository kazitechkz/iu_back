@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.promocode_lists')"
        :subtitle="__('table.promocode_management')"
        :breadcrumbs="[__('table.promocode_management')]"
        :routes="['promocode.index']"
    >
        <a href="{{route("promocode.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.promocode_create_subtitle')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:promocode.promocode-table/>
            </div>
        </div>
    </div>


@endsection
