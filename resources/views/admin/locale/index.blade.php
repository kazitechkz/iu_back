@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.locale_lists')"
        :subtitle="__('table.locale_management')"
        :breadcrumbs="[__('table.locale_management')]"
        :routes="['locale.index']"
    >
        <a href="{{route("locale.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.locale_create_title')}}

        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:locale.locale-table/>
            </div>
        </div>
    </div>


@endsection
