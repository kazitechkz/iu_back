@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.gender_lists')"
        :subtitle="__('table.gender_management')"
        :breadcrumbs="[__('table.gender_management')]"
        :routes="['gender.index']"
    >
        <a href="{{route("gender.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.gender_create_title')}}

        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:gender.gender-table/>
            </div>
        </div>
    </div>


@endsection
