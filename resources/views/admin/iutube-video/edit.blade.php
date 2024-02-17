@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.iutube_video_edit_title') .':'. $video->title"
        :subtitle="__('table.iutube_video_edit_subtitle')"
        :breadcrumbs="[__('table.iutube_video_management'),__('table.iutube_video_edit_title')]"
        :routes="['iutube-video.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:i-u-tube-video.edit :video="$video"/>
            </div>
        </div>
    </div>


@endsection
