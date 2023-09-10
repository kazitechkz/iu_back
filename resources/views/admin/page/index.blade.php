@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.page_lists')"
        :subtitle="__('table.page_management')"
        :breadcrumbs="[__('table.page_management')]"
        :routes="['page.index']"
    >
        <a href="{{route("page.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.page_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:page.page-table/>
            </div>
        </div>
    </div>


@endsection
