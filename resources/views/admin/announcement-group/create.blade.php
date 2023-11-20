@extends('layouts.default')
@section('content')
    <x-layer-components.content-navbar
        :title="__('table.announcement_group_create_title')"
        :subtitle="__('table.announcement_group_create_subtitle')"
        :breadcrumbs="[__('table.announcement_group_management'),__('table.announcement_group_create_title')]"
        :routes="['announcement-group.index']"
    />
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <livewire:announcement-group.create/>
            </div>
        </div>
    </div>


@endsection
