@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.iutube_author_lists')"
        :subtitle="__('table.iutube_author_management')"
        :breadcrumbs="[__('table.iutube_author_management')]"
        :routes="['iutube-author.index']"
    >
        <a href="{{route("iutube-author.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.iutube_author_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:i-u-tube-author.i-u-tube-author-table/>
            </div>
        </div>
    </div>


@endsection
