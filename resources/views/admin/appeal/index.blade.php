@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.appeal_lists')"
        :subtitle="__('table.appeal_management')"
        :breadcrumbs="[__('table.appeal_management')]"
        :routes="['appeal.index']"
    >
        <a href="{{route("appeal.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.appeal_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:appeal.appeal-table/>
            </div>
        </div>
    </div>


@endsection
