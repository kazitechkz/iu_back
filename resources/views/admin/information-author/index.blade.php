@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.information_author_lists')"
        :subtitle="__('table.information_author_management')"
        :breadcrumbs="[__('table.information_author_management')]"
        :routes="['information-author.index']"
    >
        <a href="{{route("information-author.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.information_author_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:information-author.information-author-table/>
            </div>
        </div>
    </div>


@endsection
