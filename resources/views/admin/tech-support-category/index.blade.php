@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.tech_support_category_lists')"
        :subtitle="__('table.tech_support_category_management')"
        :breadcrumbs="[__('table.tech_support_category_management')]"
        :routes="['tech-support-category.index']"
    >
        <a href="{{route("tech-support-category.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.tech_support_category_create_title')}}

        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:tech-support-category.tech-support-category-table/>
            </div>
        </div>
    </div>


@endsection
