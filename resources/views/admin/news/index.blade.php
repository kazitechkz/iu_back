@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.news_lists')"
        :subtitle="__('table.news_management')"
        :breadcrumbs="[__('table.news_management')]"
        :routes="['news.index']"
    >
        <a href="{{route("news.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.news_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:news.news-table/>
            </div>
        </div>
    </div>


@endsection

