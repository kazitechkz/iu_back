@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.iutube_video_lists')"
        :subtitle="__('table.iutube_video_management')"
        :breadcrumbs="[__('table.iutube_video_management')]"
        :routes="['iutube-video.index']"
    >
        <a href="{{route("iutube-video.create")}}" class="btn btn-primary mt-2 mt-xl-0">
            {{__('table.iutube_video_create_title')}}
        </a>

    </x-layer-components.content-navbar>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:i-u-tube-video.i-u-tube-video-table/>
            </div>
        </div>
    </div>


@endsection
