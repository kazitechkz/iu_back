@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.forum_create_title')"
        :subtitle="__('table.forum_create_subtitle')"
        :breadcrumbs="[__('table.forum_management'),__('table.forum_create_title')]"
        :routes="['forum.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:forum.create/>
            </div>
        </div>
    </div>


@endsection
