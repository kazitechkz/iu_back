@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.forum_lists')"
        :subtitle="__('table.forum_management')"
        :breadcrumbs="[__('table.forum_management')]"
        :routes="['forum.index']"
    >
        <a href="{{route("discuss.create")}}" class="btn btn-primary mt-2 mt-xl-0">Создать</a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:discuss.discuss-table :forum="$forum" />
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               <livewire:discuss.create :forum="$forum"></livewire:discuss.create>
            </div>
        </div>
    </div>

@endsection
