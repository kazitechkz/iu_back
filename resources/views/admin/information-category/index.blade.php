@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.information_category_lists')"
        :subtitle="__('table.information_category_management')"
        :breadcrumbs="[__('table.information_category_management')]"
        :routes="['information-category.index']"
    >
        <a href="{{route("information-category.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.information_category_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:information-category.information-category-table/>
            </div>
        </div>
    </div>


@endsection
