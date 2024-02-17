@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.iutube_video_lists')"
        :subtitle="__('table.iutube_video_create_subtitle')"
        :breadcrumbs="[__('table.iutube_video_management'),__('table.iutube_video_create_title')]"
        :routes="['iutube-video.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:i-u-tube-video.create/>
            </div>
        </div>
    </div>


@endsection
